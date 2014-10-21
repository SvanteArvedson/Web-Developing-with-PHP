<?php

namespace model;

/**
 * Handles the session object
 */
class Session {

    public static $keyUser = 'user';
    private static $keySignature = 'signature';
    public static $keyQuiz = 'quiz';
    public static $keyAnswers = 'answers';

    public function __construct($signature) {
        if (!$signature) {
            throw new \InvalidArgumentException('$signature can\'t be null or empty', -1);
        }
        
        session_start();
        if ($this->isKeySet(self::$keySignature) && $this->getValue(self::$keySignature) !== $signature) {
            // if request uses a stolen session
            session_destroy();
        } else {
            $this->save(self::$keySignature, $signature);
        }
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
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    public function getValueOnce($key) {
        $value = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        unset($_SESSION[$key]);
        return $value;
    }
    
    public function save($key, $value) {
        $_SESSION[$key] = $value;
    }

}