<?php

namespace model;

class Course implements \Serializable {
    
    public static $maxLength = 255;
    
    private $id;
    private $name;
    private $description;
    private $quiz;
    private $teachers;
    private $students;
    
    public function __construct($id, $name, $description, array $quiz, array $teachers, array $students) {
        $this -> id =  $id;
        $this -> name = $name;
        $this -> description = $description;
        $this -> quiz = $quiz;
        $this -> teachers = $teachers;
        $this -> students = $students;
    }
    
    public function getId() {
        return $this -> id;
    }
    
    private function setId($id) {
        $this -> id;
    }
    
    public function getName() {
        return $this -> name;
    }
    
    public function setName($name) {
        $this -> name = $name;
    }
    
    public function getDescription() {
        return $this -> description;
    }

    public function setDescription($description) {
        $this -> description = $description;
    }

    public function getQuiz() {
        return $this -> quiz;
    }

    public function getTeachers() {
        return $this -> teachers;
    }
    
    public function setTeachers($teachers) {
        $this -> teachers = $teachers;
    }
    
    public function getStudents() {
        return $this -> students;
    }
    
    public function setStudents(array $students) {
        $this -> students = $students;
    }

    public function serialize() {
        $courseArray = array($this -> getId(), $this -> getName(), $this -> getDescription(), $this -> getQuiz(), $this -> getTeachers(), $this -> getStudents());
        return serialize($courseArray);
    }
    
    public function unserialize($courseString) {
        $courseArray = unserialize($courseString);
        
        $this -> id = $courseArray[0];
        $this -> name = $courseArray[1];
        $this -> description = $courseArray[2];
        $this -> quiz = $courseArray[3];
        $this -> teachers = $courseArray[4];
        $this -> students = $courseArray[5];
    }
}
