<?php

namespace model;

require_once dirname(__FILE__) . '/Question.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/AnswerRepository.php';

/**
 * Repository class to table "question" in database
 */
class QuestionRepository extends Repository {
    
    /**
     * @var $tableName String Name of the question table
     */
    private static $tableName = 'question';
    
    /**
     * @var $id String Name of tables id-field in question table
     */
    private static $id = 'id';
    
    /**
     * @var $text String Name of field containg the question in question table
     */
    private static $text = 'text';
    
    /**
     * @var $answer String Foreign key-field to answer table (the correct answer)
     */
    private static $answer = 'answer';
    
    /**
     * Relation table connects the question with three incorrect answers
     *
     * @var $relationTable String Name of the relation table
     */
    private static $relationTable = 'quizquestion';
    
    /**
     * @var $keyQuiz String Foreign key-field to quiz table in relation table
     */
    private static $keyQuiz = 'quiz';
    
    /**
     * @var $keyQuestion String Foreign key-field to question table in relation table
     */
    private static $keyQuestion = 'question';
    
    /**
     * Get \model\Question objects belonging to the given quiz
     * 
     * @param $quizId int The id of the quiz the questions should belong to
     * @return array An array with \model\Question objects 
     */
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

            return $this -> makeQuestionObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    /**
     * Helper function turns result rows into an array of \model\Question objects
     * 
     * @param $results array An array with results
     * @return array An array with \model\Question objects or an empty array
     */
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

    /**
     * Helper function turns a result into a \model\Question object
     * 
     * @param $result A result from the sql query
     * @return \model\Question A \model\Question object
     */
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