<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Quiz.php';
require_once dirname(__FILE__).'/../../src/model/Answer.php';
require_once dirname(__FILE__).'/../../src/model/Question.php';

class TestQuiz implements iTest {
    
    public function run(){
        
        $answer1 = new \model\Answer(1, 'string');
        $answer2 = new \model\Answer(2, 'string');
        $answer3 = new \model\Answer(3, 'string');
        $answer4 = new \model\Answer(4, 'string');
        $answer5 = new \model\Answer(5, 'string');
        $answer6 = new \model\Answer(6, 'string');
        $answer7 = new \model\Answer(7, 'string');
        $answer8 = new \model\Answer(8, 'string');
        
        $question1 = new \model\Question(1, 'string', array($answer2, $answer3, $answer4), $answer1);
        $question2 = new \model\Question(2, 'string', array($answer6, $answer7, $answer8), $answer5);
        
        // test 1
        $id = 'string';
        $courseId = 1;
        $title = 'string';
        $questions = array($question1, $question2);
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 2
        $id = 1;
        $courseId = 'string';
        $title = 'string';
        $questions = array($question1, $question2);
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 3
        $id = 1;
        $courseId = 1;
        $title = 1;
        $questions = array($question1, $question2);
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 4
        $id = 1;
        $courseId = 1;
        $title = '';
        $questions = array($question1, $question2);
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 5
        $id = 1;
        $courseId = 1;
        $title = 'string';
        $questions = array();
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 6
        $id = 1;
        $courseId = 1;
        $title = 'string';
        $questions = array($question1, $question2);
        
        try {
            $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        } catch (\InvalidArgumentException $e) {
            throw new Exception("Test 6 not passed");
            
        }
        
        // test 7
        $answers = array();
        $quiz = new \model\Quiz($id, $courseId, $title, $questions);
        try {
            $quiz -> checkAnswers($answers);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 8
        $answers = array(1 => 1, 2 => 2);
        $score = $quiz -> checkAnswers($answers);
        assert($score == 1);
        
        echo "<p>All test for Quiz.php done!</p>";
    }    
}