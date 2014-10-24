<?php

namespace model;

require_once dirname(__FILE__) . '/Result.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/QuizRepository.php';

/**
 * Repository class to table "quizresult" in database
 */
class ResultRepository extends Repository {

    /**
     * @var $tableName String Name of the table
     */
    private static $tableName = 'quizresult';
    
    /**
     * @var $id String Name of the id field
     */
    private static $id = 'id';
    
    /**
     * @var $quizId String Foreign key-field to quiz table
     */
    private static $quizId = 'quiz';
    
    /**
     * @var $userId String Foreign key-field to user table
     */
    private static $userId = 'user';
    
    /**
     * @var $score String Name of the score-field
     */
    private static $score = 'score';
    
    /**
     * @var $createdAt String Name of the created_at-field
     */
    private static $createdAt = 'created_at';
    
    /**
     * @var $maxScore String Name of the maxscore-field
     */
    private static $maxScore = 'maxscore';

    /**
     * Inserts a result object into the database
     * 
     * @param $result \model\Result
     */
    public function insertResult(\model\Result $result) {
        try {
            $connection = $this -> getConnection();

            $sql =  "INSERT INTO " . self::$tableName . "(" . self::$quizId . ", " . self::$userId . ", " . self::$score . ", " . self::$maxScore . ") " . 
                    " VALUES ( ? , ? , ? , ? )";
            $param = array($result -> getQuiz() -> getId(), $result -> getUser() -> getId(), $result -> getScore(), $result -> getMaxScore());

            $query = $connection -> prepare($sql);
            $query -> execute($param);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Gets all rows in result-table
     * 
     * @return array An array with \model\Result objects
     */
    public function getAllResults() {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM " . self::$tableName;
            $param = array();

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToResultObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Gets all results belonging to a user
     * 
     * @param $userId int The id to the user the results should belong to
     * @return array An array with \model\Result objects
     */
    public function getResultsByUserId($userId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$userId . " = ?";
            $param = array($userId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this -> makeToResultObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Gets all results belonging to a number of users
     * 
     * @param $userIds array The ids to the users the results should belong to
     * @return array An array with \model\Result objects
     */
    public function getResultsByQuizIds(array $quizIds) {
        try {
            $connection = $this -> getConnection();

            $placeHolders = "";
            for ($i = 0; $i < count($quizIds); $i += 1) {
                if ($i == count($quizIds) - 1) {
                    $placeHolders .= "?";
                } else {
                    $placeHolders .= "?, ";
                }
            }

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$tableName . "." . self::$quizId . " IN (" . $placeHolders . ")";
            $param = $quizIds;

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToResultObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Helper function turns an array of results into an array of \model\Result objects
     * 
     * @param $results array
     * @return array An array of \model\Result objects
     */
    private function makeToResultObjects($results) {
        try {
            $ret = null;
            if ($results) {
                $ret = array();
                foreach ($results as $result) {
                    $ret[] = $this -> makeToResultObject($result);
                }
            }
            return $ret;
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    /**
     * Helper function turns a result row into an \model\Result object
     * 
     * @param $result
     * @return array A \model\Result object
     */
    private function makeToResultObject($result) {
        try {
            $userRepo = new UserRepository();
            $quizRepo = new QuizRepository();
            
            $id = $result[self::$id];
            $quiz = $quizRepo -> getQuizById($result[self::$quizId]);
            $user = $userRepo -> getUserById($result[self::$userId]);
            $score = intval($result[self::$score]);
            $createdAt = intval($result[self::$createdAt]);
            $maxScore = intval($result[self::$maxScore]);
            
            return new Result($quiz, $user, $score, $maxScore, $id, $createdAt);

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
}
