<?php

namespace model;

class Answer {
    
    private $id;
    private $text;
    
    public function __construct($id, $text) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('$id must be an integer!', -1);
        }
        if (!is_string($text) || empty($text)) {
            throw new \InvalidArgumentException('$text can\'t be empty!', -1);
        }
        
        $this -> id = $id;
        $this -> text = $text;
    }
    
    public function getId() {
        return $this -> id;
    }
    
    public function getText() {
        return $this -> text;
    }
}