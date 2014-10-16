<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

class CoursePage extends Page {
    
    public static $keyCourseId = 'course';
    
    public static $nameInfoChange = 'changeInfo';
    public static $nameTeachersChange = 'changeTeachers';
    public static $nameStudentsChange = 'changeStudents';
    public static $nameCourseName = 'courseName';
    public static $nameDescription = 'courseDescription';
    public static $nameTeachers = 'courseTeachers[]';
    public static $nameStudents = 'courseStudents[]';
    
    public function getUrlParameters($action) {
        switch ($action) {
            case Action::SHOW_COURSE :
                return array(self::$keyCourseId => $_GET[self::$keyCourseId]);
                break;
            case Action::EDIT_COURSE :
                return array(self::$keyCourseId => $_GET[self::$keyCourseId]);
                break;
        }
    }

    public function getInputs() {
        return $_POST;
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

    public function echoEditCourse(\model\User $user, \model\Course $course, $allTeachers, $allStudents, $teachersOnCourse, $studentsOnCourse) {       
        $title = "QuizApp - redigera " . $course->getName();
        include (dirname(__FILE__) . '/templates/editCourse.php');
    }    
}
