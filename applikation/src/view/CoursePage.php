<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

class CoursePage extends Page {
    
    private static $keyCourse = 'course';
    
    public static $keyCourseId = 'course';
    
    public static $nameInfoChange = 'changeInfo';
    public static $nameTeachersChange = 'changeTeachers';
    public static $nameStudentsChange = 'changeStudents';
    public static $nameCourseName = 'courseName';
    public static $nameDescription = 'courseDescription';
    public static $nameTeachers = 'courseTeachers[]';
    public static $nameStudents = 'courseStudents[]';
    public static $nameArrayTeachers = 'courseTeachers';
    public static $nameArrayStudents = 'courseStudents';
    
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
    
    public function createErrorMessage($errorCode) {
        switch ($errorCode) {
            case \model\ErrorCode::COURSE_NAME_EMPTY :
                $errorMessage = "Kursnamn saknas";
                break;
            case \model\ErrorCode::COURSE_DESCRIPTION_EMPTY :
                $errorMessage = "Beskrivning saknas";
                break;
            case \model\ErrorCode::NO_PRIVILEGES :
                $errorMessage = "Du har inte behörgihet att se den begärda sidan";
                break;
            case \model\ErrorCode::COURSE_DONT_EXISTS :
                $errorMessage = "Den efterfrågade kursen existerar inte";
                break;
        }

        $this -> addErrorMessage($errorMessage);
    }
    
    public function createSuccessMessage() {
        $this -> addSuccessMessage("Kursen uppdaterades");
    }
    
    public function saveCourse($course) {
        $serializedCourse = serialize($course);
        $serializedCourse = utf8_encode($serializedCourse);
        $this->cookie->save(self::$keyCourse, $serializedCourse);
    }
    
    public function echoListCourses(\model\User $user, $courses) {
        if ($user -> getPrivileges() !== \model\Privileges::ADMIN) {
            $title = "QuizApp - Mina kurser";
        } else {
            $title = "QuizApp - Alla kurser";
        }
        
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        
        include (dirname(__FILE__) . '/templates/listCourses.php');
    }
    
    public function echoCourse(\model\User $user, \model\Course $course) {
        $title = "QuizApp - " . $course->getName();
        $successMessage = $this -> cookie -> cookieIsset(self::$keySuccessMessage) ? $this -> cookie -> loadOnce(self::$keySuccessMessage) : null;
        include (dirname(__FILE__) . '/templates/course.php');
    }

    public function echoEditCourse(\model\User $user, \model\Course $courseOrg, $allTeachers, $allStudents) {       
        $title = "QuizApp - redigera kurs";
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        
        if ($this -> cookie -> cookieIsset(self::$keyCourse)) {
            $serializedCourse = $this -> cookie -> loadOnce(self::$keyCourse);
            $serializedCourse = utf8_decode($serializedCourse);
            
            $course = unserialize($serializedCourse);
        } else {
            $course = $courseOrg;
        }

        include (dirname(__FILE__) . '/templates/editCourse.php');
    }    
}
