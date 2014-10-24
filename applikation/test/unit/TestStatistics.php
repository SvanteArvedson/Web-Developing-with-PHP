<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Statistics.php';
require_once dirname(__FILE__).'/../../src/model/Result.php';
require_once dirname(__FILE__).'/../../src/model/QuizRepository.php';
require_once dirname(__FILE__).'/../../src/model/UserRepository.php';

class TestStatistics implements iTest {
    
    public function run() {
        
        $quizRepo = new \model\QuizRepository();
        $userRepo = new \model\UserRepository();
        $quizId1 = 1;
        $quizId2 = 3;
        $quiz1 = $quizRepo -> getQuizById($quizId1);
        $quiz2 = $quizRepo -> getQuizById($quizId2);
        $userId = 13;
        $user = $userRepo -> getUserById($userId);
        
        $result1 = new \model\Result($quiz1, $user, 5, 10);
        $result2 = new \model\Result($quiz1, $user, 10, 10);
        $result3 = new \model\Result($quiz2, $user, 0, 10);
        $result4 = new \model\Result($quiz2, $user, 5, 10);
        
        $statistics = new \model\Statistics(array($result1, $result2, $result3, $result4));
        
        // test 1
        assert($statistics -> getNbrOfResults() == 4);
        
        // test 2
        assert($statistics -> getAverageScoreInPercent() == 50);
        
        // test 3
        assert($statistics -> getAverageScoreByCourseId($quiz1 -> getCourseId()) == 75);
        
        // test 4
        assert($statistics -> getNbrOfResultsByCourseId($quiz1 -> getCourseId()) == 2);
        
        // test 5
        assert($statistics -> getAverageScoreByQuizId($quizId1) == 75);
        
        // test 6
        assert($statistics -> getNbrOfResultsByQuizId($quizId1) == 2);

        echo "<p>All test for Statistics.php done!</p>";
    }    
}