<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Course.php';
require_once dirname(__FILE__).'/../../src/model/QuizRepository.php';
require_once dirname(__FILE__).'/../../src/model/UserRepository.php';

class TestCourse implements iTest {
    
    public function run() {
        $quizRepo = new \model\QuizRepository();
        $userRepo = new \model\UserRepository();
        $courseId = 5;
        
        // test 1
        $id = $courseId;
        $name = 'string';
        $description = 'string';
        $quiz = $quizRepo -> getQuizOnCourse($courseId);
        $teachers = $userRepo -> getTeachersOnCourse($courseId);
        $students = $userRepo -> getStudentsOnCourse($courseId);
        
        try {
            $course = new \model\Course($id, $name, $description, $quiz, $teachers, $students);
        } catch (\Exception $e) {
            throw new Exception("Test 1 not passed");
        }
        
        echo "<p>All test for Course.php done!</p>";
    }
}