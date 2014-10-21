<?php

namespace model;

require_once dirname(__FILE__) . '/Quiz.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/QuestionRepository.php';

class QuizRepository extends Repository {
    
    private static $tableName = 'quiz';
    private static $id = 'id';
    private static $course = 'course';
    private static $title = 'quizname';
    
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