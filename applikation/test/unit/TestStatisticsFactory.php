<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/UserRepository.php';
require_once dirname(__FILE__).'/../../src/model/StatisticsFactory.php';

class TestStatisticsFactory implements iTest {
    
    public function run() {
        $factory = new \model\StatisticsFactory();
        $userRepo = new \model\UserRepository();
        $student = $userRepo -> getUserById(13);
        $teacher = $userRepo -> getUserById(18);
        
        // test 1
        $statistics = $factory -> createStatisticsOnStudent($student);
        assert(get_class($statistics) === 'model\Statistics');
        
        // test 2
        try {
            $statistics = $factory -> createStatisticsOnStudent($teacher);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 3
        $statistics = $factory -> createStatisticsOnTeacher($teacher);
        assert(get_class($statistics) === 'model\Statistics');
        
        // test 4
        try {
            $statistics = $factory -> createStatisticsOnTeacher($student);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 5
        $statistics = $factory -> createStatisticsOnAllCourses();
        assert(get_class($statistics) === 'model\Statistics');
        
        echo "<p>All test for StatisticsFactory.php done!</p>";
    }    
}