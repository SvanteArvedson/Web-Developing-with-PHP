<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/QuestionRepository.php';

class TestQuestionRepository implements iTest {
    
    public function run(){
        $repo = new \model\QuestionRepository();
        $quizId = 1;
        
        // test 1
        $questions = $repo -> getQuestionsByQuizId($quizId);
        assert(is_array($questions));
        // test 2
        assert(get_class($questions[0]) === 'model\Question');
        
        echo "<p>All test for QuestionRepository.php done!</p>";
    }    
}