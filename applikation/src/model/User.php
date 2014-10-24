<?php

namespace model;

require_once dirname(__FILE__).'/Privileges.php';

/**
 * Represents a user of the application
 */
class User {

    /**
     * @var $id int
     */
    private $id;
    
    /**
     * @var $username String
     */
    private $username;
    
    /**
     * @var $password String
     */
    private $password;
    
    /**
     * @var $salt String Salt to crypt the password
     */
    private $salt;
    
    /**
     * @var $privileges String [ADMIN, TECHER, STUDENT]
     */
    private $privileges;

    /**
     * @param $id int
     * @param $username String
     * @param $password String
     * @param $salt String
     * @param $privileges String
     */
    public function __construct($id, $username, $password, $salt, $privileges) {
        $this -> id = $id;
        $this -> username = $username;
        $this -> password = $password;
        $this -> salt = $salt;
        $this -> privileges = $privileges;
    }
    
    /**
     * @return int The id of the user
     */
    public function getId() {
        return $this -> id;
    }
    
    /**
     * @return String The username of the user
     */
    public function getUsername() {
        return $this -> username;
    }
    
    /**
     * @return String The passwrod of the user
     */
    public function getPassword() {
        return $this -> password;
    }
    
    /**
     * @return String The salt of the user
     */
    public function getSalt() {
        return $this -> salt;
    }
    
    /**
     * @return String Users privileges
     */
    public function getPrivileges() {
        return $this -> privileges;
    }
}
