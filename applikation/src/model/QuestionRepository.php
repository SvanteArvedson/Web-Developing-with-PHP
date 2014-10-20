<?php

namespace model;

require_once dirname(__FILE__) . '/Question.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/AnswerRepository.php';

class QuestionRepository extends Repository {
    
    private static $tableName = 'question';
    private static $id = 'id';
    private static $text = 'text';
    private static $answer = 'answer';
    
    private static $relationTable = 'quizquestion';
    private static $keyQuiz = 'quiz';
    private static $keyQuestion = 'question';
    
    public function getQuestionsByQuizId($quizId) {
        try {
            $connection = $this -> getConnection();

            $sql =  "SELECT " . self::$id . ", " . self::$text . ", " . self::$answer . 
                    " FROM " . self::$tableName . 
                        " INNER JOIN " . self::$relationTable . " ON " . self::$tableName . "." . self::$id . " = " . self::$relationTable . "." . self::$keyQuestion .
                    " WHERE " . self::$relationTable . "." . self::$keyQuiz . " = ?";

            $param = array($quizId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            $results = $query -> fetchAll();

            return $this -> makeQuestionObjects($results);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    private function makeQuestionObjects($results) {
        try {
            $ret = null;
            if ($results) {
                $ret = array();
                foreach ($results as $result) {
                    $ret[] = $this -> makeQuestionObject($result);
                }
            }
            return $ret;

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    private function makeQuestionObject($result) {
        try {
            $answerRepo = new AnswerRepository();
            
            $id = intval($result[self::$id]);
            $text = $result[self::$text];
            $correctAnswerId = $result[self::$answer];
            
            $correctAnswer = $answerRepo -> getAnswerById($correctAnswerId);
            $incorrectAnswers = $answerRepo -> getIncorrectAnswersByQuestionId($id);
            
            return new Question($id, $text, $incorrectAnswers, $correctAnswer);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    } 
}