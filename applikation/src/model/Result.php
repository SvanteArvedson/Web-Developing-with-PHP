<?php

namespace model;

/**
 * Represent a result from an answered quiz
 */
class Result {
    
    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $quiz \model\Quiz
     */
    private $quiz;
    
    /**
     * @var $user \model\User
     */
    private $user;
    
    /**
     * @var $score int
     */
    private $score;
    
    /**
     * @var $createdAt int Timestamp when the quiz was answered
     */
    private $createdAt;
    
    /**
     * @var $maxscore int
     */
    private $maxscore;
    
    /**
     * @param $quiz \model\Quiz
     * @param $user \model\User
     * @param $score int
     * @param $maxscore int
     * @param $id int
     * @param $createdAt int If null the result is new, if not null the result comes from the database
     */
    public function __construct(\model\Quiz $quiz, \model\User $user, $score, $maxscore, $id = -1, $createdAt = null) {
        if ($quiz == null) {
            throw new \InvalidArgumentException('$quiz can\'t me null', -1);
        }
        if ($user == null) {
            throw new \InvalidArgumentException('$user can\'t me null', -1);
        }
        if (!is_int($score) || $score < 0 || $score > $maxscore) {
            throw new \InvalidArgumentException('$score must be an integer greater then or equal to 0 and nor greater then $maxsacore', -1);
        }
        if (!is_int($maxscore) || $maxscore < 1) {
            throw new \InvalidArgumentException('$maxscore must be an integer greater than or equal to 1', -1);
        }
        
        $this -> id = $id;
        $this -> quiz = $quiz;
        $this -> user = $user;
        $this -> score = $score;
        $this -> maxscore = $maxscore;
        $this -> createdAt = $createdAt ? $createdAt : time();
    }
    
    /**
     * @return int The retult id
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * @return \model\Quiz The quiz the result belongs to
     */
    public function getQuiz() {
        return $this -> quiz;
    }
    
    /**
     * @return \model\User The user the result belongs to
     */
    public function getUser() {
        return $this -> user;
    }
    
    /**
     * @return int the result score
     */
    public function getScore() {
        return $this -> score;
    }
    
    /**
     * @return int the max score of the quiz
     */
    public function getMaxScore() {
        return $this -> maxscore;
    }
    
    /**
     * @return the time the result was inserted into the database
     */
    public function getCreatedAt() {
        return $this -> createdAt;
    }
}