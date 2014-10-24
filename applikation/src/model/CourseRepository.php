<?php

namespace model;

require_once dirname(__FILE__) . '/Course.php';
require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/QuizRepository.php';

/**
 * Repository class to table "course" in database
 */
class CourseRepository extends Repository {

    /**
     * @var $tableName String Name of table course
     */
    private static $tableName = 'course';
    
    /**
     * @var $id String Field-name for id field
     */
    private static $id = 'id';
    
    /**
     * @var $name String Field-name for course name field
     */
    private static $name = 'name';
    
    /**
     * @var $description String Field-name for course description field
     */
    private static $description = 'description';
    
    /**
     * @var $relationTable String Name for relation table connecting tables course - user
     */
    private static $relationTable = 'courseparticipation';
    
    /**
     * @var $courseKey String Foreign key-field to related course
     */
    private static $courseKey = 'course';
    
    /**
     * @var $userKey String Foreign key-field to related user
     */
    private static $userKey = 'user';
    
    /**
     * Gets all courses where the given user participates
     * 
     * @param $userId int The id for the user that should participate in the returned courses
     * @return array An array with \model\Course objects
     */
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

    /**
     * Gets a course with the given id if the given user participates in that course
     * 
     * @param $userId int The id for the user
     * @param $courseId int the id for the course
     * @return \model\Course A \model\Course object or NULL
     */
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

    /**
     * Gets all courses in tha database
     * 
     * @return array An array with \model\Course objects
     */
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
    
    /**
     * Gets the course with the given id
     * 
     * @param $courseId int the id for the course
     * @return \model\Course A \model\Course object or NULL
     */
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

    /**
     * Update a row in the database table
     * 
     * @param $course \model\Course The course object with updated information
     */
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

    /**
     * Helper function turns an array of result sets into an array of \model\Course objects
     * 
     * @param $results An array of result sets
     * @return array An array with \model\Course objects
     */
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
    
    /**
     * Helper function turn a result set into a \model\Course object
     * 
     * @param $result A result set
     * @return \model\Course A \model\Course object
     */
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
