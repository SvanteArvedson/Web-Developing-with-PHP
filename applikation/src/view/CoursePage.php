<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

class CoursePage extends Page {
    
    public static $keyCourseId = 'course';
    
    public function getInputParameters($action) {
        switch ($action) {
            case Action::SHOW_COURSE :
                return array(self::$keyCourseId => $_GET[self::$keyCourseId]);
                break;
        }
    }
    
    public function echoListCourses(\model\User $user, $courses) {
        if ($user -> getPrivileges() !== \model\Privileges::ADMIN) {
            $title = "QuizApp - Mina kurser";
        } else {
            $title = "QuizApp - Alla kurser";
        }
        
        include (dirname(__FILE__) . '/templates/listCourses.php');
    }
    
    public function echoCourse(\model\User $user, \model\Course $course, $teachers, $students) {
        $title = "QuizApp - " . $course->getName();
        include (dirname(__FILE__) . '/templates/course.php');
    }
    
}
