<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/QuizPage.php';
require_once dirname(__FILE__) . '/../view/Navigation.php';
require_once dirname(__FILE__) . '/../model/Session.php';
require_once dirname(__FILE__) . '/../model/QuizRepository.php';
require_once dirname(__FILE__) . '/../model/ResultRepository.php';
require_once dirname(__FILE__) . '/../model/Result.php';

class QuizHandler {

    private $quizPage;
    private $navigation;
    private $session;

    public function __construct() {
        $this -> quizPage = new \view\QuizPage();
        $this -> navigation = new \view\Navigation();
        $this -> session = new \model\Session($this -> quizPage -> getSignature());
    }

    public function doQuiz() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quizRepo = new \model\QuizRepository();
            $param = $this -> quizPage -> getUrlParameters();
            $quiz = $quizRepo -> getQuizById($param[\view\QuizPage::$keyQuizId]);

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

    public function answerQuiz() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quizRepo = new \model\QuizRepository();
            $answers = $this -> quizPage -> getInputs();
            $quiz = $this -> session -> getValue(\model\Session::$keyQuiz);

            if ($quiz) {
                if ($this -> isAllowedToQuiz($user, $quiz)) {
                    try {
                        $resultRepo = new \model\ResultRepository();
                        $score = $quiz -> checkAnswers($answers);
                        $result = new \model\Result($quiz, $user, $score, $quiz -> getMaxScore());
                        
                        $resultRepo -> insertResult($result);
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

    public function presentQuizResult() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $quiz = $this -> session -> getValueOnce(\model\Session::$keyQuiz);
            $answers = $this -> session -> getValueOnce(\model\Session::$keyAnswers);

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