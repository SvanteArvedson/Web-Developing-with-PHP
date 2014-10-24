<?php

namespace model;

/**
 * Represent a question
 */
class Question {
    
    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $text String The question
     */
    private $text;
    
    /**
     * @var $incorrectAnswers array An array of \model\Answer objects
     */
    private $incorrectAnswers;
    
    /**
     * @var $correctAnswer \model\Answer
     */
    private $correctAnswer;
    
    /**
     * @param $id int
     * @param $text String The question
     * @param $incorrectAnswers array An array of \model\Answer objects
     * @param $correctAnswer \model\Answer The correct answer to the question
     */
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
    
    /**
     * @return int The id of the question
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * @return String The question
     */
    public function getText() {
        return $this -> text;
    }
    
    /**
     * @return array An array with all four answers in the question (3 incorrect + 1 correct)
     */
    public function getAllAnswers() {
        $allAnswers = $this -> incorrectAnswers;
        $allAnswers[] = $this -> correctAnswer;

        return $allAnswers;
    }
    
    /**
     * Gets the answer text belonging to the answer with the given id
     *
     * @param $answerId int The given answer id
     * @return String The answer text belonging to the answer with the given id
     */
    public function getAnswerText($answerId) {
        foreach ($this -> getAllAnswers() as $answer) {
            if ($answer -> getId() == $answerId) {
                return $answer -> getText();
            }
        }
        
        return null;
    }
    
    /**
     * @return \model\Answer The correct answer to the question
     */
    public function getCorrectAnswer() {
        return $this -> correctAnswer;
    }
}