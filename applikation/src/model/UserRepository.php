<?php

namespace model;

require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/UserFactory.php';

/**
 * Repository class to table "user" in database
 * @author Svante Arvedson
 */
class UserRepository extends Repository {

    public static $tableName = 'user';

    public static $id = 'id';
    private static $username = 'username';
    private static $password = 'password';
    private static $salt = 'salt';
    private static $privileges = 'privileges';


    public function getUserByUsername($username) {
        try {
            $connection = $this -> getConnection();

            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE ' . self::$username . ' = ?';
            $param = array($username);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            $result = $query -> fetch();

            if ($result != null) {
                $uf = new UserFactory();
                return $uf -> createUser($result[self::$id], $result[self::$username], $result[self::$password], $result[self::$salt], $result[self::$privileges]);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

}
