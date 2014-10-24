<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/CourseRepository.php';

class TestCourseRepository implements iTest {
    
    public function run() {
        $repository = new \model\CourseRepository();
        $courseId = 5;
        $userId = 13;  
            
        // test 1
        $course = $repository -> getCourseWithParticipationBy($userId, $courseId);
        assert(get_class($course) === 'model\Course');

        // test 2
        $participants = array_merge($course->getTeachers(), $course->getStudents());
        $participation = false;
        foreach ($participants as $participant) {
            if ($participant->getId() == $userId) {
                $participation = true;
                break;
            }
        }
        assert($participation);

        $courses = $repository -> getCoursesWithParticipationBy($userId);
        // test 3
        assert(is_array($courses));
        // test 4
        assert(get_class($courses[0]) === 'model\Course');

        $courses = $repository -> getAllCourses();
        // test 5
        assert(is_array($courses));
        // test 6
        assert(get_class($courses[0]) === 'model\Course');

        $course = $repository -> getCourseById($courseId);
        // test 7
        assert(get_class($course) === 'model\Course');
        // test 8
        assert($course->getId() == $courseId);
        
        // test 9
        $course = new \model\Course($courseId, "", "", array(), array(), array());
        try {
            $repository -> updateCourseInfo($course);
            assert(false);
        } catch(\Exception $e) {
            // test 9 passed
        }
        
        // test 10
        $course->setName("A real name");
        try {
            $repository -> updateCourseInfo($course);
            assert(false);
        } catch(\Exception $e) {
            // test 10 passed
        }
        
        echo "<p>All test for CourseRepository.php done!</p>";
    }
}