<?php

namespace model;

require_once dirname(__FILE__) . '/ResultRepository.php';
require_once dirname(__FILE__) . '/CourseRepository.php';
require_once dirname(__FILE__) . '/Statistics.php';

/**
 * Creats objects of type \model\Statistics
 */
class StatisticsFactory {
    
    /**
     * Creates a \model\Statistics object suitable for a student
     * 
     * @param $student \model\User The student that should use the statistics
     * @return \model\Statistics
     */
    public function createStatisticsOnStudent(\model\User $student) {
        if ($student -> getPrivileges() != Privileges::STUDENT) {
            throw new \InvalidArgumentException('$student was not a student', -1);
        }
        
        // Result objects to create the statistics with
        $repo = new ResultRepository();
        $results = $repo -> getResultsByUserId($student -> getId());
        $statistics = new Statistics($results);
        return $statistics;
    }
    
    /**
     * Creates a \model\Statistics object suitable for a teacher
     * 
     * @param $teacher \model\User The teacher that should use the statistics
     * @return \model\Statistics
     */
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
    
    /**
     * Creates a \model\Statistics with all results in the database
     * 
     * @return \model\Statistics
     */
    public function createStatisticsOnAllCourses() {
        $resultRepo = new ResultRepository();
        $results = $resultRepo -> getAllResults();
        
        $statistics = new Statistics($results);
        return $statistics;
    }
}