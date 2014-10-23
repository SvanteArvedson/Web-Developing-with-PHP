<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

/**
 * Shows and creates HTML pages for course functions
 */
class CoursePage extends Page {
    
    /**
     * @var $keyCourseId String Key for saving course id in URL
     */
    public static $keyCourseId = 'course';
    
    /**
     * @var $nameInfoChange String Name attribute for form element
     */
    public static $nameInfoChange = 'changeInfo';
    
    /**
     * @var $nameTeachersChange String Name attribute for form element
     */
    public static $nameTeachersChange = 'changeTeachers';
    
    /**
     * @var $nameStudentsChange String Name attribute for form element
     */
    public static $nameStudentsChange = 'changeStudents';
    
    /**
     * @var $nameCourseName String Name attribute for form element
     */
    public static $nameCourseName = 'courseName';
    
    /**
     * @var $nameDescription String Name attribute for form element
     */
    public static $nameDescription = 'courseDescription';
    
    /**
     * @var $nameTeachers String Name attribute for form element
     */
    public static $nameTeachers = 'courseTeachers[]';
    
    /**
     * @var $nameStudents String Name attribute for form element
     */
    public static $nameStudents = 'courseStudents[]';
    
    /**
     * @var $nameArrayTeachers String Name attribute for form element
     */
    public static $nameArrayTeachers = 'courseTeachers';
    
    /**
     * @var $nameArrayStudents String Name attribute for form element
     */
    public static $nameArrayStudents = 'courseStudents';
    
    /**
     * @param $action String Action in action
     * 
     * @return String Content in URL parameters
     */
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
    
    /**
     * Creates an error message and saves it in a cookie
     * 
     * @param $errorCode integer
     */
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
    
    /**
     * Creates a success message and saves it in a cookie
     */
    public function createSuccessMessage() {
        $this -> addSuccessMessage("Kursen uppdaterades");
    }
   
    /**
     * Creates HTML response for index.php?action=showCourses
     * 
     * @param $user \model\User
     * @param $courses An array with \model\Course objects
     */
    public function echoListCourses(\model\User $user, $courses) {
        if ($user -> getPrivileges() == \model\Privileges::STUDENT) {
            $title = "QuizApp - Mina kurser";
        } else if ($user -> getPrivileges() == \model\Privileges::TEACHER) {
            $title = "QuizApp - Kurser";
        } else {
            $title = "QuizApp - Alla kurser";
        }
        
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        
        include (dirname(__FILE__) . '/templates/listCourses.php');
    }
    
    /**
     * Creates HTML response for index.php?action=showCourse&course=__
     * 
     * @param $user \model\User
     * @param $course \model\Course
     */
    public function echoCourse(\model\User $user, \model\Course $course) {
        $title = "QuizApp - " . $course->getName();
        $successMessage = $this -> cookie -> cookieIsset(self::$keySuccessMessage) ? $this -> cookie -> loadOnce(self::$keySuccessMessage) : null;
        include (dirname(__FILE__) . '/templates/course.php');
    }

    /**
     * Creates HTML response for index.php?action=editCourse&course=__
     * 
     * @param $user \model\User
     * @param $course \model\Course
     * @param $allTeachers An array with \model\User objects, all teachers in database
     * @param $allStudents An array with \model\User objects, all students in database
     */
    public function echoEditCourse(\model\User $user, \model\Course $course, $allTeachers, $allStudents) {       
        $title = "QuizApp - redigera kurs";
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        include (dirname(__FILE__) . '/templates/editCourse.php');
    }    
}
