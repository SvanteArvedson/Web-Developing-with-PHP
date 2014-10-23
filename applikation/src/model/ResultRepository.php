<?php

namespace model;

require_once dirname(__FILE__) . '/Result.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/QuizRepository.php';

class ResultRepository extends Repository {

    private static $tableName = 'quizresult';
    private static $id = 'id';
    private static $quizId = 'quiz';
    private static $userId = 'user';
    private static $score = 'score';
    private static $createdAt = 'created_at';
    private static $maxScore = 'maxscore';

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
