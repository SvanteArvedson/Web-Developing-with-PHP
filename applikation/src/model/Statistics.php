<?php

namespace model;

class Statistics {
    
    private $results;
    
    public function __construct(array $results = array()) {
        $this -> results = $results;
    }
    
    public function getNbrOfResults() {
        return count($this -> results);
    }
    
    public function getAverageScoreInPercent() {
        if ($this -> getNbrOfResults() == 0) {
            throw new \Exception ("No results to count average score on", -1);
        }
        
        $maxScore = 0;
        $score = 0;
        foreach ($this -> results as $result) {
            $maxScore += $result -> getMaxScore();
            $score += $result -> getScore();
        }
        
        return $score / $maxScore * 100;
    }
    
    public function getAverageScoreByCourseId($courseId) {
        $courseResults = $this -> getResultsByCourseId($courseId);
        
        if (count($courseResults) == 0) {
            throw new \Exception ("No results to count average score on", -1);
        }
        
        $maxScore = 0;
        $score = 0;
            foreach ($courseResults as $result) {
                $maxScore += $result -> getMaxScore();
                $score += $result -> getScore();
            }
        
        return $score / $maxScore * 100;
    }
    
    public function getNbrOfResultsByCourseId($courseId) {
        $courseResults = $this -> getResultsByCourseId($courseId);
        return count($courseResults);
    }
    
    public function getAverageScoreByQuizId($quizId) {
        $quizResults = $this -> getResultsByQuizId($quizId);
        
        if (count($quizResults) == 0) {
            throw new \Exception ("No results to count average score on", -1);
        }
        
        $maxScore = 0;
        $score = 0;
            foreach ($quizResults as $result) {
                $maxScore += $result -> getMaxScore();
                $score += $result -> getScore();
            }
        
        return $score / $maxScore * 100;
    }
    
    public function getNbrOfResultsByQuizId($quizId) {
        $quizResults = $this -> getResultsByQuizId($quizId);
        return count($quizResults);
    }
    
    private function getResultsByCourseId($courseId) {
        $courseResults = array();
        foreach ($this -> results as $result) {
            if ($result -> getQuiz() -> getCourseId() == $courseId) {
                $courseResults[] = $result;
            }
        }
        return $courseResults;
    }
    
    private function getResultsByQuizId($quizId) {
        $quizResults = array();
        foreach ($this -> results as $result) {
            if ($result -> getQuiz() -> getId() == $quizId) {
                $quizResults[] = $result;
            }
        }
        return $quizResults;
    }
}