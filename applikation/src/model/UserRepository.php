<?php

namespace model;

require_once dirname(__FILE__) . '/Privileges.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/UserFactory.php';

/**
 * Repository class to table "user" in database
 * @author Svante Arvedson
 */
class UserRepository extends Repository {

    // for table courseparticipation
    private static $relationTable = 'courseparticipation';
    private static $courseKey = 'course';
    private static $userKey = 'user';

    // fro table user
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

            if ($result) {
                $uf = new UserFactory();
                return $uf -> createUser($result[self::$id], $result[self::$username], $result[self::$password], $result[self::$salt], $result[self::$privileges]);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getUserById($userId) {
        try {
            $connection = $this -> getConnection();

            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE ' . self::$id . ' = ?';
            $param = array($userId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            $result = $query -> fetch();

            if ($result) {
                $uf = new UserFactory();
                return $uf -> createUser($result[self::$id], $result[self::$username], $result[self::$password], $result[self::$salt], $result[self::$privileges]);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getUsersByIds(array $userIds) {
        try {
            $connection = $this -> getConnection();

            $placeHolders = "";
            for ($i = 0; $i < count($userIds); $i += 1) {
                if ($i == count($userIds) - 1) {
                    $placeHolders .= "?";
                } else {
                    $placeHolders .= "?, ";
                }
            }

            $sql = "SELECT * FROM " . self::$tableName . " WHERE " . self::$tableName . "." . self::$id . " IN (" . $placeHolders . ")";
            $param = $userIds;

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToUserObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getTeachersOnCourse($courseId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT ".self::$tableName.".".self::$id.", ".self::$tableName.".".self::$username.", ".self::$tableName.".".self::$password.", ".self::$tableName.".".self::$salt.", ".self::$tableName.".".self::$privileges.
                   " FROM ".self::$tableName.
                       " INNER JOIN ".self::$relationTable." ON ".self::$tableName.".".self::$id." = ".self::$relationTable.".".self::$userKey.
                   " WHERE ".self::$tableName.".".self::$privileges." = '".Privileges::TEACHER."'".
                       " AND ".self::$relationTable.".".self::$courseKey." = ?";
            $param = array($courseId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToUserObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    public function getStudentsOnCourse($courseId) {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT ".self::$tableName.".".self::$id.", ".self::$tableName.".".self::$username.", ".self::$tableName.".".self::$password.", ".self::$tableName.".".self::$salt.", ".self::$tableName.".".self::$privileges.
                   " FROM ".self::$tableName.
                       " INNER JOIN ".self::$relationTable." ON ".self::$tableName.".".self::$id." = ".self::$relationTable.".".self::$userKey.
                   " WHERE ".self::$tableName.".".self::$privileges." = '".Privileges::STUDENT."'".
                       " AND ".self::$relationTable.".".self::$courseKey." = ?";
            $param = array($courseId);

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToUserObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function getAllTeachers() {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM ".self::$tableName." WHERE ".self::$privileges." = '".Privileges::TEACHER."'";
            $param = array();

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToUserObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    public function getAllStudents() {
        try {
            $connection = $this -> getConnection();

            $sql = "SELECT * FROM ".self::$tableName." WHERE ".self::$privileges." = '".Privileges::STUDENT."'";
            $param = array();

            $query = $connection -> prepare($sql);
            $query -> execute($param);

            return $this->makeToUserObjects($query -> fetchAll());

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }

    public function updateTeachersOnCourse($courseId, $teachers) {
        try {
            $connection = $this -> getConnection();
            
            $sql =  "DELETE " . self::$relationTable . 
                    " FROM " . self::$relationTable .
                        " INNER JOIN " . self::$tableName . 
                        " ON " . self::$relationTable . "." . self::$userKey . " = " . self::$tableName . "." . self::$id . 
                    " WHERE " . self::$tableName . "." . self::$privileges . " = '" . Privileges::TEACHER . "'" .
                    " AND " . self::$courseKey . " = ?";
            $param = array($courseId);
            
            $query = $connection -> prepare($sql);
            $query -> execute($param);
            
            if (count($teachers) !== 0) {
                
                $insertPlaceholders = "";
                
                for ($i = 0; $i < count($teachers); $i += 1) {
                    if ($i === count($teachers) - 1) {
                        $insertPlaceholders .= "( ? , ? )";
                    } else {
                        $insertPlaceholders .= "( ? , ? ), ";
                    }
                }
                
                $sql = "INSERT INTO " . self::$relationTable . 
                       " VALUES " . $insertPlaceholders;

                $param = array();
                foreach ($teachers as $teacher) {
                    $param[] = $courseId;
                    $param[] = $teacher->getId();
                }
    
                $query = $connection -> prepare($sql);
                $query -> execute($param);
            }

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    public function updateStudentsOnCourse($courseId, $students) {
        try {
            $connection = $this -> getConnection();
            
            $sql =  "DELETE " . self::$relationTable . 
                    " FROM " . self::$relationTable .
                        " INNER JOIN " . self::$tableName . 
                        " ON " . self::$relationTable . "." . self::$userKey . " = " . self::$tableName . "." . self::$id . 
                    " WHERE " . self::$tableName . "." . self::$privileges . " = '" . Privileges::STUDENT . "'" .
                    " AND " . self::$courseKey . " = ?";
            $param = array($courseId);
            
            $query = $connection -> prepare($sql);
            $query -> execute($param);
            
            if (count($students) !== 0) {
                
                $insertPlaceholders = "";
                for ($i = 0; $i < count($students); $i += 1) {
                    if ($i === count($students) - 1) {
                        $insertPlaceholders .= "( ? , ? )";
                    } else {
                        $insertPlaceholders .= "( ? , ? ), ";
                    }
                }
                
                $sql = "INSERT INTO " . self::$relationTable . 
                       " VALUES " . $insertPlaceholders;

                $param = array();
                foreach ($students as $student) {
                    $param[] = $courseId;
                    $param[] = $student->getId();
                }
    
                $query = $connection -> prepare($sql);
                $query -> execute($param);
            }

        } catch (\Exception $e) {
            throw new \Exception($e -> getMessage(), -1);
        }
    }
    
    private function makeToUserObjects($results) {
        $ret = array();
        $uf = new UserFactory();
        
        if ($results != null) {           
            foreach ($results as $result) {
                $ret[] = $uf -> createUser($result[self::$id], $result[self::$username], $result[self::$password], $result[self::$salt], $result[self::$privileges]);
            }
        }
        
        return $ret;
    }

}
