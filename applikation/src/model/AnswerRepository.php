<?php

namespace model;

require_once dirname(__FILE__) . '/Answer.php';
require_once dirname(__FILE__) . '/Repository.php';

class AnswerRepository extends Repository {
    
    private static $tableName = 'answer';
    private static $id = 'id';
    private static $text = 'text';
    
    private static $relationTable = 'incorrectanswer';
    private static $keyAnswer = 'answer';
    private static $keyQuestion = 'question';
    
    public function getAnswerById($answerId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$id . " = ?";
            $param = array($answerId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToAnswerObject($query -> fetch());
            
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    public function getIncorrectAnswersByQuestionId($questionId) {
        // SELECT id, text FROM answer INNER JOIN incorrectanswer ON answer.id = incorrectanswer.answer WHERE incorrectanswer.question = 1;
        
        try {
            $connection = $this -> getConnection();

            $sql =  "SELECT " . self::$id . ", " . self::$text .
                    " FROM " . self::$tableName . 
                        " INNER JOIN " . self::$relationTable . " ON " . self::$relationTable . "." . self::$keyAnswer . " = " . self::$tableName . "." . self::$id .
                    " WHERE " . self::$relationTable . "." . self::$keyQuestion . " = ?";
            $param = array($questionId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToAnswerObjects($result = $query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    private function makeToAnswerObjects($results) {
        $ret = null;
        
        if ($results != null) {
            $ret = array();
            foreach ($results as $result) {
                $ret[] = $this -> makeToAnswerObject($result);
            }
        }
        return $ret;
    }
    
    private function makeToAnswerObject($result) {
        try {
            return new Answer(intval($result[self::$id]), $result[self::$text]);
        } catch (\Exception $e) {
            return null;
        }
    }
}