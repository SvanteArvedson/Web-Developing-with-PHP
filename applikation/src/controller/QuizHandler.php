<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/QuizPage.php';
require_once dirname(__FILE__) . '/../view/Navigation.php';
require_once dirname(__FILE__) . '/../model/Session.php';
require_once dirname(__FILE__) . '/../model/QuizRepository.php';

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
            
            if ($this -> quizPage -> isPostback()) {
                // Do postback action here
            } else {
                $quizRepo = new \model\QuizRepository();
                $param = $this -> quizPage -> getUrlParameters();
                $quiz = $quizRepo -> getQuizById($param[\view\QuizPage::$keyQuizId]);
    
                if ($quiz) {
                    if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                        $this -> quizPage -> echoDoQuiz($user, $quiz);
                    } else {
                        $courseRepo = new \model\CourseRepository();
                        $usersCourses = $courseRepo -> getCoursesWithParticipationBy($user -> getId());
                        
                        $allowed = false;
                        foreach ($usersCourses as $course) {
                            if ($course -> getId() == $quiz -> getCourseId()) {
                                $allowed = true;
                            }
                        }
                        
                        if ($allowed) {
                            $this -> quizPage -> echoDoQuiz($user, $quiz);
                        } else {
                            $this -> quizPage -> createErrorMessage(\model\ErrorCode::NO_PRIVILEGES);
                            $this -> navigation -> redirectToShowCourses();
                        }
                    }                
                } else {
                    $this -> quizPage -> createErrorMessage(\model\ErrorCode::QUIZ_DONT_EXISTS);
                    $this -> navigation -> redirectToShowCourses();
                }
            }
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }
}
