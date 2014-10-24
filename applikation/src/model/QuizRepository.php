<?php

namespace model;

require_once dirname(__FILE__) . '/Quiz.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/QuestionRepository.php';

/**
 * Repository class to table "quiz" in database
 */
class QuizRepository extends Repository {
    
    /**
     * @var $tableName String The name of the quiz table
     */
    private static $tableName = 'quiz';
    
    /**
     * @var $id String Name of the id-field
     */
    private static $id = 'id';
    
    /**
     * @var $course String Foreign key to course table
     */
    private static $course = 'course';
    
    /**
     * @var $title String Name of the field containg the quiz name
     */
    private static $title = 'quizname';
    
    /**
     * Gets the row in the table with the given id
     * 
     * @param $quizId int The id of the quiz to get
     * @return \model\Quiz A \model\Quiz object
     */
    public function getQuizById($quizId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$id . " = ?";
            $param = array($quizId);
            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeQuizObject($query -> fetch());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Gets the rows in the table related to the given courseId
     * 
     * @param $courseId int The courseId teh quiz objects should be related to
     * @return array An array with \model\Quiz objects
     */
    public function getQuizOnCourse($courseId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$course . " = ?";
            $param = array($courseId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeQuizObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Helper function turn result rows into an array of \model\Quiz objects
     * 
     * @param $results array An array with rows from the database
     * @return array An array with \model\Quiz objects or an empty array
     */
    private function makeQuizObjects($results) {
        try {
            $ret = null;
            if ($results) {
                $ret = array();
                foreach ($results as $result) {
                    $ret[] = $this -> makeQuizObject($result);
                }
            }
            return $ret;
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Helper function turn a result row into a \model\Quiz object
     * 
     * @param $result resultset A row from the database
     * @return \model\Quiz A \model\Quiz object or NULL
     */
    private function makeQuizObject($result) {
        try {
            if ($result) {
            
                $questionRepo = new QuestionRepository();
                
                $id = intval($result[self::$id]);
                $courseId = intval($result[self::$course]);
                $title = $result[self::$title];
                $questions = $questionRepo -> getQuestionsByQuizId($id);
                shuffle($questions);
                
                return new Quiz($id, $courseId, $title, $questions);
            } else {
                return null;
            }
            
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
}