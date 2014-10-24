<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Question.php';
require_once dirname(__FILE__).'/../../src/model/AnswerRepository.php';


class TestQuestion implements iTest {
    
    public function run(){
        $answerRepo = new \model\AnswerRepository();
        $answerId = 1;
        $questionId = 1;
        
        // test 1
        $id = 'string';
        $text = 'string';
        $incorrectAnswers = $answerRepo -> getIncorrectAnswersByQuestionId($questionId);
        $correctAnswer = $answerRepo -> getAnswerById($answerId);
        
        try {
            $question = new \model\Question($id, $text, $incorrectAnswers, $correctAnswer);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 2
        $id = 1;
        $text = 1;

        try {
            $question = new \model\Question($id, $text, $incorrectAnswers, $correctAnswer);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 3
        $text = '';

        try {
            $question = new \model\Question($id, $text, $incorrectAnswers, $correctAnswer);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }

        // test 4
        $text = 'string';
        $incorrectAnswers = array();

        try {
            $question = new \model\Question($id, $text, $incorrectAnswers, $correctAnswer);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 5
        $incorrectAnswers = $answerRepo -> getIncorrectAnswersByQuestionId($questionId);

        try {
            $question = new \model\Question($id, $text, $incorrectAnswers, $correctAnswer);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }

        echo "<p>All test for Question.php done!</p>";
    }    
}