<?php

namespace model;

/**
 * Calculates statistics based on a collection of \model\Result objects
 */
class Statistics {
    
    /**
     * @var $results array A collection of \model\Result objects
     */
    private $results;
    
    /**
     * @param $results array A collection of \model\Result objects
     */
    public function __construct(array $results = array()) {
        $this -> results = $results;
    }
    
    /**
     * @return int The total number of result objects
     */
    public function getNbrOfResults() {
        return count($this -> results);
    }
    
    /**
     * @return float The average score based on all results in percent
     */
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
    
    /**
     * @param $courseId int The id of the course to calculate statistics on
     * @return float The average score based on results in a course
     */
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
    
    /**
     * @param $courseId int The id of the course to calculate statistics on
     * @return int The total number of results in this course
     */
    public function getNbrOfResultsByCourseId($courseId) {
        $courseResults = $this -> getResultsByCourseId($courseId);
        return count($courseResults);
    }
    
    /**
     * @param $quizId int The id of the quiz to calculate statistics on
     * @return float The average score based on results on a quiz
     */
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
    
    /**
     * @param $quizId int The id of the quiz to calculate statistics on
     * @return int The total number of results on this quiz
     */
    public function getNbrOfResultsByQuizId($quizId) {
        $quizResults = $this -> getResultsByQuizId($quizId);
        return count($quizResults);
    }
    
    /**
     * Helper function to get results on course
     * 
     * @param $courseId int
     * @return array The selected \model\Result objects
     */
    private function getResultsByCourseId($courseId) {
        $courseResults = array();
        foreach ($this -> results as $result) {
            if ($result -> getQuiz() -> getCourseId() == $courseId) {
                $courseResults[] = $result;
            }
        }
        return $courseResults;
    }
    
    /**
     * Helper function to get results on quiz
     * 
     * @param $quizId int
     * @return array The selected \model\Result objects
     */
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