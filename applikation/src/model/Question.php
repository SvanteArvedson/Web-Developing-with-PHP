<?php

namespace model;

class Question {
    
    private $id;
    private $text;
    private $incorrectAnswers;
    private $correctAnswer;
    
    public function __construct($id, $text, array $incorrectAnswers, $correctAnswer) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('$id must be an integer!', -1);
        }
        if (!is_string($text) || empty($text)) {
            throw new \InvalidArgumentException('$text can\'t be empty!', -1);
        }
        if (!is_array($incorrectAnswers) || count($incorrectAnswers) === 0) {
            throw new \InvalidArgumentException('$incorrectAnswers must be an array and can\'t be empty!', -1);
        }
        if (get_class($correctAnswer) != 'model\Answer') {
            throw new \InvalidArgumentException('$correctAnswer must be an Answer object', -1);
        }
        
        $this -> id = $id;
        $this -> text = $text;
        $this -> incorrectAnswers = $incorrectAnswers;
        $this -> correctAnswer = $correctAnswer;
    }
    
    public function getId() {
        return $this -> id;
    }
    
    public function getText() {
        return $this -> text;
    }
    
    public function getAllAnswers() {
        $allAnswers = $this -> incorrectAnswers;
        $allAnswers[] = $this -> correctAnswer;

        return $allAnswers;
    }
    
    public function getCorrectAnswer() {
        return $this -> correctAnswer;
    }
}