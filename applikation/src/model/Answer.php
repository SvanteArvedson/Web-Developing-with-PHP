<?php

namespace model;

/**
 * Represent a Answer
 */
class Answer {
    
    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $text String
     */
    private $text;
    
    /**
     * @param $id int
     * @param $text String
     */
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
    
    /**
     * @return int The id of the answer
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * @return String The text of the answer
     */
    public function getText() {
        return $this -> text;
    }
}