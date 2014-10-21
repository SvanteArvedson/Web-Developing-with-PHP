<?php

namespace model;

class Result {
    
    private $id;
    private $quiz;
    private $user;
    private $score;
    private $createdAt;
    private $maxscore;
    
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
    
    public function getId() {
        return $this -> id;
    }
    
    public function getQuiz() {
        return $this -> quiz;
    }
    
    public function getUser() {
        return $this -> user;
    }
    
    public function getScore() {
        return $this -> score;
    }
    
    public function getMaxScore() {
        return $this -> maxscore;
    }

    public function getCreatedAt() {
        return $this -> createdAt;
    }
}