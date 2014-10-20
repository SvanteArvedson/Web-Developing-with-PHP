<?php

namespace model;

class Quiz {
    
    private $id;
    private $courseId;
    private $title;
    private $questions;
    
    public function __construct($id, $courseId, $title, array $questions) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('$id must be an integer!', -1);
        }
        if (!is_int($courseId)) {
            throw new \InvalidArgumentException('$courseId must be an integer!', -1);
        }
        if (!is_string($title) || empty($title)) {
            throw new \InvalidArgumentException('$title can\'t be empty!', -1);
        }
        if (!is_array($questions) || count($questions) === 0) {
            throw new \InvalidArgumentException('$questions must be an array and can\'t be empty!', -1);
        }
        
        $this -> id = $id;
        $this -> courseId = $courseId;
        $this -> title = $title;
        $this -> questions = $questions;
    }
    
    public function getId() {
        return $this -> id;
    }
    
    public function getCourseId() {
        return $this -> courseId;
    }
    
    public function getTitle() {
        return $this -> title;
    }
    
    public function getQuestions() {
        return $this -> questions;
    }
}