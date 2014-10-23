<?php

namespace model;

require_once dirname(__FILE__) . '/ResultRepository.php';
require_once dirname(__FILE__) . '/CourseRepository.php';
require_once dirname(__FILE__) . '/Statistics.php';

class StatisticsFabric {
    
    public function createStatisticsOnStudent(\model\User $student) {
        if ($student -> getPrivileges() != Privileges::STUDENT) {
            throw new \InvalidArgumentException('$student was not a student', -1);
        }
        
        $repo = new ResultRepository();
        $results = $repo -> getResultsByUserId($student -> getId());
        
        $statistics = new Statistics($results);
        return $statistics;
    }
    
    public function createStatisticsOnTeacher(\model\User $teacher) {
        if ($teacher -> getPrivileges() != Privileges::TEACHER) {
            throw new \InvalidArgumentException('$teacher was not a teacher', -1);
        }
        
        $courseRepo = new CourseRepository();
        $courses = $courseRepo -> getCoursesWithParticipationBy($teacher -> getId());
        
        $quizIds = array();
        foreach ($courses as $course) {
            foreach ($course -> getQuiz() as $quiz) {
                if (!in_array($quiz -> getId(), $quizIds)) {
                    $quizIds[] = $quiz -> getId();
                }
            }
        }
        
        $resultRepo = new ResultRepository();
        $results = $resultRepo -> getResultsByQuizIds($quizIds);
        
        $statistics = new Statistics($results);
        return $statistics;
    }
    
    public function createStatisticsOnAllCourses() {
        $resultRepo = new ResultRepository();
        $results = $resultRepo -> getAllResults();
        
        $statistics = new Statistics($results);
        return $statistics;
    }
}