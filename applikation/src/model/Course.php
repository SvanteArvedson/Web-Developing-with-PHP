<?php

namespace model;

/**
 * Represent a course
 */
class Course {
    
    /**
     * @var $maxLength int Max length for course name
     */
    public static $maxLength = 255;
    
    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $name String
     */
    private $name;
    
    /**
     * @var $description String 
     */
    private $description;
    
    /**
     * @var $quiz \model\Quiz
     */
    private $quiz;
    
    /**
     * @var $teachers array An array of \model\User objects
     */
    private $teachers;
    
    /**
     * @var $students array An array of \model\User objects
     */
    private $students;
    
    /**
     * @param $id int
     * @param $name String
     * @param $description String 
     * @param $quiz array An array with \model\Quiz objects
     * @param $teachers array An array with \model\User objects
     * @param $students array An array with \model\User objects
     */
    public function __construct($id, $name, $description, array $quiz, array $teachers, array $students) {
        $this -> id =  $id;
        $this -> name = $name;
        $this -> description = $description;
        $this -> quiz = $quiz;
        $this -> teachers = $teachers;
        $this -> students = $students;
    }
    
    /**
     * @return int The id of the course
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * Sets the id of the course
     *
     * @param $id int The new Id
     */
    private function setId($id) {
        $this -> id;
    }
    
    /**
     * @return String The name of the course
     */
    public function getName() {
        return $this -> name;
    }
    
    /**
     * Sets the name of the course
     * 
     * @param The new name of the course
     */
    public function setName($name) {
        $this -> name = $name;
    }
    
    /**
     * @return String The description of the course
     */
    public function getDescription() {
        return $this -> description;
    }

    /**
     * Sets the description of the course
     * 
     * @param String The new course description
     */
    public function setDescription($description) {
        $this -> description = $description;
    }
    
    /**
     * @return array An array with the course quiz
     */
    public function getQuiz() {
        return $this -> quiz;
    }

    /**
     * @return array An array with the course teachers
     */
    public function getTeachers() {
        return $this -> teachers;
    }
    
    /**
     * Sets the course teachers
     * 
     * @param array An array with \model\User objects
     */
    public function setTeachers(array $teachers) {
        $this -> teachers = $teachers;
    }
    
    /**
     * @return array An array with the course students
     */
    public function getStudents() {
        return $this -> students;
    }
    
    /**
     * Sets the course students
     * 
     * @param array An array with \model\User objects
     */
    public function setStudents(array $students) {
        $this -> students = $students;
    }
}
