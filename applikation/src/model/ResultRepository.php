<?php

namespace model;

require_once dirname(__FILE__) . '/Result.php';
require_once dirname(__FILE__) . '/Repository.php';

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
}
