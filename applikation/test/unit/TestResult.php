<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Result.php';
require_once dirname(__FILE__).'/../../src/model/QuizRepository.php';
require_once dirname(__FILE__).'/../../src/model/UserRepository.php';

class TestResult implements iTest {
    
    public function run() {
        $quizRepo = new \model\QuizRepository();
        $userRepo = new \model\UserRepository();
        $quizId = 1;
        $userId = 13;
        
        // test 1
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = 'string';
        $maxscore = 5;

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 2
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = -5;
        $maxscore = 5;

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 3
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = 7;
        $maxscore = 5;

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 4
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = 3;
        $maxscore = 'string';

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 5
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = 0;
        $maxscore = 0;

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 6
        $quiz = $quizRepo -> getQuizById($quizId);
        $user = $userRepo -> getUserById($userId);
        $score = 3;
        $maxscore = 5;

        try {
            $result = new \model\Result($quiz, $user, $score, $maxscore);
        } catch (\InvalidArgumentException $e) {
            throw new Exception("Test 6 not passed");
        }
        
        echo "<p>All test for Result.php done!</p>";
    }    
}