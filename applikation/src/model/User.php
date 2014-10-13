<?php

namespace model;

require_once dirname(__FILE__).'/Privileges.php';

class User {

    private $id;
    private $username;
    private $password;
    private $salt;
    private $privileges;

    public function __construct($id, $username, $password, $salt, $privileges) {
        $this -> id = $id;
        $this -> username = $username;
        $this -> password = $password;
        $this -> salt = $salt;
        $this -> privileges = $privileges;
    }
    
    public function getId() {
        return $this -> id;
    }

    public function getUsername() {
        return $this -> username;
    }

    public function getPassword() {
        return $this -> password;
    }
    
    public function getSalt() {
        return $this -> salt;
    }
    
    public function getPrivileges() {
        return $this -> privileges;
    }
}
