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

    public function __construct() {
        $this -> coursePage = new \view\CoursePage();
        $this -> navigation = new \view\Navigation();
        $this -> session = new \model\Session($this -> coursePage -> getSignature());
    }

    public function showCourses() {
        $user = $this -> session -> getValue(\model\Session::$keyUser);
        $repo = new \model\CourseRepository();

        if ($this -> session -> isUserAuthenticated() && $user -> getPrivileges() !== \model\Privileges::ADMIN) {
            $courses = $repo -> getCoursesWithParticipationBy($user -> getId());
            $this -> coursePage -> echoListCourses($user, $courses);
        } else {
            $courses = $repo -> getAllCourses();
            $this -> coursePage -> echoListCourses($user, $courses);
        }
    }

}
