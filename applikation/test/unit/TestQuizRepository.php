<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/QuizRepository.php';

class TestQuizRepository implements iTest {
    
    public function run() {
        $repo = new \model\QuizRepository();
        $quizId = 1;
        $courseId = 5;
        
        // test 1
        $quiz = $repo -> getQuizById($quizId);
        assert(get_class($quiz) === 'model\Quiz');
        
        // test 2
        $quiz = $repo -> getQuizOnCourse($courseId);
        assert(is_array($quiz));
        // test 3
        assert(get_class($quiz[0]) === 'model\Quiz');
        
        echo "<p>All test for QuizRepository.php done!</p>";
    }    
}