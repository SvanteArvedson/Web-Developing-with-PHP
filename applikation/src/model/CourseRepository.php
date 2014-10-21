<?php

namespace model;

require_once dirname(__FILE__) . '/Course.php';
require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/QuizRepository.php';

class CourseRepository extends Repository {

    // for table courseparticipation
    private static $relationTable = 'courseparticipation';
    private static $courseKey = 'course';
    private static $userKey = 'user';

    // for table course
    private static $tableName = 'course';
    private static $id = 'id';
    private static $name = 'name';
    private static $description = 'description';

    public function getCoursesWithParticipationBy($userId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT " . self::$tableName . "." . self::$id . ", " . self::$tableName . "." . self::$name . ", " . self::$tableName . "." . self::$description . 
                   " FROM " . self::$relationTable . 
                       " INNER JOIN " . self::$tableName . " ON " . self::$relationTable . "." . self::$courseKey . " = " . self::$tableName . "." . self::$id .
                   " WHERE " . self::$relationTable . "." . self::$userKey . " = ?";
            $param = array($userId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);
            
            return $this -> makeToCourseObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getCourseWithParticipationBy($userId, $courseId) {
        $userRepo = new UserRepository();
        
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT " . self::$tableName . "." . self::$id . ", " . self::$tableName . "." . self::$name . ", " . self::$tableName . "." . self::$description . 
                   " FROM " . self::$relationTable .
                       " INNER JOIN " . self::$tableName . " ON " . self::$relationTable . "." . self::$courseKey . " = " . self::$tableName . "." . self::$id .
                   " WHERE " . self::$relationTable . "." . self::$userKey . " = ? ".
                       " AND " . self::$relationTable . "." . self::$courseKey . " = ?";
            $param = array($userId, $courseId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToCourseObject($query -> fetch());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getAllCourses() {
        try {
            $connection = $this -> getConnection();
            
            $sql = "SELECT * FROM " . self::$tableName;
            $param = array();

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToCourseObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    public function getCourseById($courseId) {
        $userRepo = new UserRepository();
        
        try {
            $connection = $this -> getConnection();
            
            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$tableName . "." . self::$id . " = ?";
            $param = array($courseId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToCourseObject($query -> fetch());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function updateCourseInfo($course) {
        if (!$course->getName()) {
            throw new \InvalidArgumentException("Course must have a name", ErrorCode::COURSE_NAME_EMPTY);
        }
        if (!$course->getDescription()) {
            throw new \InvalidArgumentException("Course must have a name", ErrorCode::COURSE_DESCRIPTION_EMPTY);
        }
        
        try {
            $connection = $this -> getConnection();
            
            $sql = "UPDATE " . self::$tableName . 
                   " SET " . self::$name . " = ?, " . self::$description . " = ?" .
                   " WHERE " . self::$id . " = ?"; 
            $param = array($course->getName(), $course->getDescription(), $course->getId());

            $query = $connection -> prepare($sql);
            $query -> execute($param);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    private function makeToCourseObjects($results) {
        try {
            $ret = null;
            if ($results) {
                $ret = array();
                foreach ($results as $result) {
                    $ret[] = $this -> makeToCourseObject($result);
                }
            }
            
            return $ret;
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    private function makeToCourseObject($result) {
        try {
            if ($result) {
                $userRepo = new UserRepository();
                $quizRepo = new QuizRepository();
                
                $quiz = $quizRepo -> getQuizOnCourse($result[self::$id]);
                $teachers = $userRepo -> getTeachersOnCourse($result[self::$id]);
                $students = $userRepo -> getStudentsOnCourse($result[self::$id]);
    
                $quiz = $quiz != null ? $quiz : array();
                $teachers = $teachers != null ? $teachers : array();
                $students = $students != null ? $students : array();
    
                return new Course($result[self::$id], $result[self::$name], $result[self::$description], $quiz, $teachers, $students);
            } else {
                return null;;
            }
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

}
