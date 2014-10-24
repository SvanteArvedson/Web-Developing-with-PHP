<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/ResultRepository.php';

class TestResultRepository implements iTest {
    
    public function run() {
        $repo = new \model\ResultRepository();
        $userId = 13;
        $quizIds = array(1, 2);
        
        // test 1
        $results = $repo -> getAllResults();
        assert(is_array($results));
        // test 2
        assert(get_class($results[0]) === 'model\Result');
        
        // test 3
        $results = $repo -> getResultsByUserId($userId);
        assert(is_array($results));
        // test 4
        assert(get_class($results[0]) === 'model\Result');

        // test 5
        $results = $repo -> getResultsByQuizIds($quizIds);
        assert(is_array($results));
        // test 6
        assert(get_class($results[0]) === 'model\Result');

        echo "<p>All test for ResultRepository.php done!</p>";
    }    
}