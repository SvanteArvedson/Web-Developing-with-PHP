<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/CoursePage.php';
require_once dirname(__FILE__) . '/../view/Navigation.php';
require_once dirname(__FILE__) . '/../model/User.php';
require_once dirname(__FILE__) . '/../model/Session.php';
require_once dirname(__FILE__) . '/../model/CourseRepository.php';

class CourseHandler {

    private $coursePage;
    private $navigation;
    private $session;
    private $action;

    public function __construct($action) {
        $this -> coursePage = new \view\CoursePage();
        $this -> navigation = new \view\Navigation();
        $this -> session = new \model\Session($this -> coursePage -> getSignature());
        $this -> action = $action;
    }

    public function editCourse() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $courseRepo = new \model\CourseRepository();
        $userRepo = new \model\UserRepository();
        
        if ($this -> session -> isUserAuthenticated() && $user -> getPrivileges() !== \model\Privileges::STUDENT) {
            $param = $this -> coursePage -> getUrlParameters($this -> action);
            $course = $courseRepo -> getCourseById($param[\view\CoursePage::$keyCourseId]);

            if ($course) {
                
                if ($this -> coursePage -> isPostback()) {
                    
                    $inputs = $this -> coursePage -> getInputs();
                    
                    if ($inputs[\view\CoursePage::$nameInfoChange] === "true") {
                        var_dump("Kursinformationen ändrades.");
                    }
                    if ($inputs[\view\CoursePage::$nameTeachersChange] === "true") {
                        var_dump("Kursens lärare ändrades.");
                    }
                    if ($inputs[\view\CoursePage::$nameStudentsChange] === "true") {
                        var_dump("Kursens studenter ändrades.");
                    }
                    var_dump("Sista utropet!");
                    die();
                
                    //$this -> navigation -> redirectToShowCourse($course -> getId());
                } else {
                    $allTeachers = $userRepo -> getAllTeachers();
                    $allStudents = $userRepo -> getAllStudents();
                    $teachersOnCourse = $userRepo -> getTeachersOnCourse($param[\view\CoursePage::$keyCourseId]);
                    $studentsOnCourse = $userRepo -> getStudentsOnCourse($param[\view\CoursePage::$keyCourseId]);
                    $this -> coursePage -> echoEditCourse($user, $course, $allTeachers, $allStudents, $teachersOnCourse, $studentsOnCourse);
                }
                
            } else {
                $this -> navigation -> redirectToShowCourses();
            }
            
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }

    public function showCourses() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $repo = new \model\CourseRepository();

        if ($this -> session -> isUserAuthenticated()) {
            
            if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                $courses = $repo -> getAllCourses();
            } else {
                $courses = $repo -> getCoursesWithParticipationBy($user -> getId());
            }
            
            $this -> coursePage -> echoListCourses($user, $courses);
            
        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }

    public function showCourse() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $courseRepo = new \model\CourseRepository();
        $userRepo = new \model\UserRepository();

        if ($this -> session -> isUserAuthenticated()) {
            $param = $this -> coursePage -> getUrlParameters($this -> action);

            if ($user -> getPrivileges() === \model\Privileges::ADMIN) {
                $course = $courseRepo -> getCourseById($param[\view\CoursePage::$keyCourseId]);
            } else {
                $course = $courseRepo -> getCourseWithParticipationBy($user -> getId(), $param[\view\CoursePage::$keyCourseId]);
            }

            if ($course) {
                $teachers = $userRepo -> getTeachersOnCourse($param[\view\CoursePage::$keyCourseId]);
                $students = $userRepo -> getStudentsOnCourse($param[\view\CoursePage::$keyCourseId]);
                $this -> coursePage -> echoCourse($user, $course, $teachers, $students);

            } else {
                //TODO: Show custom error page here
                $this -> navigation -> redirectToShowCourses();
            }

        } else {
            $this -> navigation -> redirectToShowCourses();
        }
    }

}
