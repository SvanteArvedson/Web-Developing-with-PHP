<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/AnswerRepository.php';

class TestAnswerRepository implements iTest {
    
    public function run(){
       $repo = new \model\AnswerRepository();
       
       // test 1
       $answerId = 1;
       $answer = $repo -> getAnswerById($answerId);
       assert(get_class($answer) === 'model\Answer');
       
       // test 2
       $questionId = 1;
       $answers = $repo -> getIncorrectAnswersByQuestionId($questionId);
       assert(is_array($answers));
        // test 4
        assert(get_class($answers[0]) === 'model\Answer');
       
       echo "<p>All test for AnswerRepositoy done!</p>"; 
    }    
}