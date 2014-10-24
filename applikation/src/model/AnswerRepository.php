<?php

namespace model;

require_once dirname(__FILE__) . '/Answer.php';
require_once dirname(__FILE__) . '/Repository.php';

/**
 * Repository class to table "answer" in database
 */
class AnswerRepository extends Repository {
    
    /**
     * @var $tableName String Name of answer table
     */
    private static $tableName = 'answer';
    
    /**
     * @var $id String Field-name of id field
     */
    private static $id = 'id';
    
    /**
     * @var $text String Field-name of text field
     */
    private static $text = 'text';
    
    /**
     * @var $relationTable String Name of relation table connecting answer - question
     */
    private static $relationTable = 'incorrectanswer';
    
    /**
     * @var $keyAnswer String Foreign key-field name to answer table
     */
    private static $keyAnswer = 'answer';
    
    /**
     * @var $keyQuestion String Foreign key-field name to question table
     */
    private static $keyQuestion = 'question';
    
    /**
     * Gets a \model\Answer object with the given id
     * 
     * @param $answerId int Id to a answer object
     * @return \model\Answer A \model\Answer object or NULL
     */
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
    
    /**
     * Gets incorrect answers belonging to a question
     * 
     * @param $questionId Id to a question object
     * @return array An array with \model\Answer objects
     */
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
    
    /**
     * Helper function turns an array of result sets into an array of \model\Answer objects
     * 
     * @param $results An array of result sets
     * @return array An array of \model\Answer objects
     */
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
    
    /**
     * Helper function turn a result set into a \model\Answer object
     * 
     * @param $result A result set
     * @return \model\Answer A \model\Answer object
     */
    private function makeToAnswerObject($result) {
        try {
            return new Answer(intval($result[self::$id]), $result[self::$text]);
        } catch (\Exception $e) {
            return null;
        }
    }
}