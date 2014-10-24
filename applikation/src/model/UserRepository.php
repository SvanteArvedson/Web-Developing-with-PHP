<?php

namespace model;

require_once dirname(__FILE__) . '/Privileges.php';
require_once dirname(__FILE__) . '/Repository.php';
require_once dirname(__FILE__) . '/UserFactory.php';

/**
 * Repository class to table "user" in database
 */
class UserRepository extends Repository {

    /**
     * @var $relationTable String Name of relation table user - course
     */
    private static $relationTable = 'courseparticipation';
    
    /**
     * @var $courseKey String Foreign key-field to course table
     */
    private static $courseKey = 'course';
    
    /**
     * @var $userKey String Foerign key-field to user table
     */
    private static $userKey = 'user';

    /**
     * @var $tableName String Name of user table
     */
    public static $tableName = 'user';
    
    /**
     * @var $id String Name of id-field in user table
     */
    public static $id = 'id';
    
    /**
     * @var $username String Name of username-field in user table
     */
    private static $username = 'username';
    
    /**
     * @var $password String Name of password-field in user table
     */
    private static $password = 'password';
    
    /**
     * @var $salt String Name of salt-field in user table
     */
    private static $salt = 'salt';
    
    /**
     * @var $privileges String Name of privileges-field in user table
     */
    private static $privileges = 'privileges';

    /**
     * Gets the row with the given username
     * 
     * @param $username String Username to be found
     * @return \model\User The found user-object or NULL
     */
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

    /**
     * Gets the row with the given id
     * 
     * @param $userId String Id to be found
     * @return \model\User The found user-object or NULL
     */
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

    /**
     * Gets the rows with the given ids
     * 
     * @param $userIds array Array with ids to be found
     * @return array The found user-objects or an empty array
     */
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

    /**
     * Gets the users with privileges TEACHER related with the given course
     * 
     * @param $courseId int Id for the course users should be related to
     * @return array The found user-objects or an empty array
     */
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
    
    /**
     * Gets the users with privileges STUDENT related with the given course
     * 
     * @param $courseId int Id for the course users should be related to
     * @return array The found user-objects or an empty array
     */
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

    /**
     * Gets all users with privileges TEACHER
     * 
     * @return array The found user-objects or an empty array
     */
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
    
    /**
     * Gets all users with privileges STUDENT
     * 
     * @return array The found user-objects or an empty array
     */
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

    /**
     * Sets new relations between users and a course
     * 
     * @param $courseId int Id to the course users should be related to
     * @param $teachers array An array with the users that should be related to the course
     */
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
    
    /**
     * Sets new relations between users and a course
     * 
     * @param $courseId int Id to the course users should be related to
     * @param $students array An array with the users that should be related to the course
     */
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
    
    /**
     * Helper function, turn result objects into user objects
     * 
     * @param $results array An array with result objects
     * @return array An array with user objects
     */
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