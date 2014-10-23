<?php

namespace controller;

require_once dirname(__FILE__) . '/../controller/Handler.php';
require_once dirname(__FILE__) . '/../view/QuizPage.php';
require_once dirname(__FILE__) . '/../model/QuizRepository.php';
require_once dirname(__FILE__) . '/../model/ResultRepository.php';
require_once dirname(__FILE__) . '/../model/Result.php';

/**
 * Controller for quiz functions
 */
class QuizHandler extends Handler {

    /**
     * @var $quizPage \view\QuizPage
     */
    private $quizPage;

    public function __construct() {
        $this -> quizPage = new \view\QuizPage();
        parent::__construct($this -> quizPage -> getSignature());
    }

    /**
     * Called when user request URL index.php?action=doQuiz&quiz=___
     */
    public function doQuiz() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quizRepo = new \model\QuizRepository();
            $param = $this -> quizPage -> getUrlParameters();
            $quiz = $quizRepo -> getQuizById($param[\view\QuizPage::$keyQuizId]);

            // Checks if the requested quiz exists
            if ($quiz) {
                if ($this -> isAllowedToQuiz($user, $quiz)) {
                    $this -> session -> save(\model\Session::$keyQuiz, $quiz);
                    $this -> quizPage -> echoDoQuiz($user, $quiz);
                } else {
                    $this -> quizPage -> createErrorMessage(\model\ErrorCode::NO_PRIVILEGES);
                    $this -> navigation -> redirectToShowCourses();
                }                
            } else {
                $this -> quizPage -> createErrorMessage(\model\ErrorCode::QUIZ_DONT_EXISTS);
                $this -> navigation -> redirectToShowCourses();
            }
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }

    /**
     * Called when request URL is inex.php?action=answerQuiz
     */
    public function answerQuiz() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quizRepo = new \model\QuizRepository();
            $answers = $this -> quizPage -> getInputs();
            $quiz = $this -> session -> getValue(\model\Session::$keyQuiz);

            if ($quiz) {
                if ($this -> isAllowedToQuiz($user, $quiz)) {
                    try {
                        // Admin and teachers can do quiz, but the result will not be saved                   
                        if ($user -> getPrivileges() == \model\Privileges::STUDENT) {
                            $resultRepo = new \model\ResultRepository();
                            $score = $quiz -> checkAnswers($answers);
                            $result = new \model\Result($quiz, $user, $score, $quiz -> getMaxScore());
                            $resultRepo -> insertResult($result);
                        }
                        $this -> session -> save(\model\Session::$keyAnswers, $answers);
                        $this -> navigation -> redirectToShowQuizResult();
                    } catch (\Exception $e) {
                        if ($e -> getCode() != -1) {
                            $this -> quizPage -> createErrorMessage($e -> getCode());
                            $this -> navigation -> redirectToDoQuiz($quiz -> getId());
                        } else {
                            //TODO: show a custom error page here
                            var_dump($e);
                            die();
                        }
                    }
                } else {
                    $this -> quizPage -> createErrorMessage(\model\ErrorCode::ACTION_IMPOSSIBLE);
                    $this -> navigation -> redirectToShowCourses();
                }                
            } else {
                $this -> quizPage -> createErrorMessage(\model\ErrorCode::ACTION_IMPOSSIBLE);
                $this -> navigation -> redirectToShowCourses();
            }   
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }

    /**
     * Called when URL is index.php?action=showResult
     */
    public function presentQuizResult() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quiz = $this -> session -> getValueOnce(\model\Session::$keyQuiz);
            $answers = $this -> session -> getValueOnce(\model\Session::$keyAnswers);

            // Checks if user did answer the quiz
            if ($quiz && $answers) {
                $score = $quiz -> checkAnswers($answers);
                $this -> quizPage -> echoQuizResult($user, $score, $quiz, $answers);
            } else {
                $this -> quizPage -> createErrorMessage(\model\ErrorCode::ACTION_IMPOSSIBLE);
                $this -> navigation -> redirectToShowCourses();
            }
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }
    
    /**
     * Checks if user have privileges to do quiz
     */
    private function isAllowedToQuiz(\model\User $user, \model\Quiz $quiz) {
        if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
            return true;
        } else {
            $courseRepo = new \model\CourseRepository();
            $usersCourses = $courseRepo -> getCoursesWithParticipationBy($user -> getId());
            
            foreach ($usersCourses as $course) {
                if ($course -> getId() == $quiz -> getCourseId()) {
                    return true;
                }
            }
            return false;
        }
    }
}