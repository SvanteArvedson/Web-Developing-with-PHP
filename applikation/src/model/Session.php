<?php

namespace model;

class Session {

    public static $keyUser = 'user';

    public function __construct() {
        session_start();
    }

    public function loginUser(User $user) {
        $_SESSION[self::$keyUser] = $user;
    }
    
    public function logoutUser() {
        unset($_SESSION[self::$keyUser]);
    }
    
    public function isUserAuthenticated() {
        return $this->isKeySet(self::$keyUser);
    }

    private function isKeySet($key) {
        return isset($_SESSION[$key]);
    }
    
    public function getValue($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : "";
    }

}