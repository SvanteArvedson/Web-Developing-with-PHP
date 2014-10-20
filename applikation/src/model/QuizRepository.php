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

            $result = $query -> fetch();

            return $this -> makeQuizObject($result);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    private function makeQuizObject($result) {
        try {
            $questionRepo = new QuestionRepository();
            
            $id = intval($result[self::$id]);
            $courseId = intval($result[self::$course]);
            $title = $result[self::$title];
            $questions = $questionRepo -> getQuestionsByQuizId($id);
            
            return new Quiz($id, $courseId, $title, $questions);
            
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
}