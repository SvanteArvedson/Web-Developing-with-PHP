<?php

namespace model;

/**
 * Represent a quiz
 */
class Quiz {
    
    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $courseId int
     */
    private $courseId;
    
    /**
     * @var $title String
     */
    private $title;
    
    /**
     * @var $questions array An array with \model\Question objects
     */
    private $questions;
    
    /**
     * @param $id int
     * @param $courseId int
     * @param $title String
     * @param $questions array An array with \model\Question objects
     */
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
    
    /**
     * @return int The id fo the quiz
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * @return int the courseId of the quiz
     */
    public function getCourseId() {
        return $this -> courseId;
    }
    
    /**
     * @return String The title of the quiz
     */
    public function getTitle() {
        return $this -> title;
    }
    
    /**
     * @return array The \model\Question objects belonging to the quiz
     */
    public function getQuestions() {
        return $this -> questions;
    }

    /**
     * @return int The number of questions in the quiz
     */
    public function getMaxScore() {
        return count($this -> questions);
    }

    /**
     * @param array An array with answers (from answering the quiz)
     * @return int The number of correct answers
     */
    public function checkAnswers(array $answers) {
        if (count($answers) != count($this->questions)) {
            throw new \InvalidArgumentException('Number of elements in $answers must be the same as number of questions in the quiz', ErrorCode::ANSWERS_MISSING);
        }
        
        $score = 0;
        foreach ($this -> questions AS $question) {
            if ($question -> getCorrectAnswer() -> getId() == $answers[$question->getId()]) {
                $score += 1;
            }
        }
        
        return $score;
    }
}