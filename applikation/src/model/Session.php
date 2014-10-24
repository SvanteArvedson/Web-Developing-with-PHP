<?php

namespace model;

/**
 * Handles the session object
 */
class Session {

    /**
     * @var $keyUser String Key for storing \model\User object
     */
    public static $keyUser = 'user';
    
    /**
     * @var $keySignature String Key for storing request signature
     */
    private static $keySignature = 'signature';
    
    /**
     * @var $keyQuiz String Key for storing \model\Quiz object
     */
    public static $keyQuiz = 'quiz';
    
    /**
     * @var $keyAnswers String Key for storing answers on quiz
     */
    public static $keyAnswers = 'answers';

    /**
     * @param $signature String The request signature (IP and Browser)
     */
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

    /**
     * Stores the \model\User object in the session
     * 
     * @param $user \model\User
     */
    public function loginUser(\model\User $user) {
        $_SESSION[self::$keyUser] = $user;
    }
    
    /**
     * Removes the \model\User object from the session
     */
    public function logoutUser() {
        unset($_SESSION[self::$keyUser]);
    }
    
    /**
     * Checks if a user is logged in
     */
    public function isUserAuthenticated() {
        return $this->isKeySet(self::$keyUser);
    }

    /**
     * Check if the provided key is set
     * 
     * @param $key String
     */
    public function isKeySet($key) {
        return isset($_SESSION[$key]);
    }
    
    /**
     * Gets a value stored in the session
     * 
     * @param $key String Key to the value
     * @return mixed The stored value
     */
    public function getValue($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    /**
     * Gets a value stored in the session, then unsets the key
     * 
     * @param $key String Key to the value
     * @return mixed The stored value
     */
    public function getValueOnce($key) {
        $value = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        unset($_SESSION[$key]);
        return $value;
    }
    
    /**
     * Saves a value in the session
     * 
     * @param $key String The key to store the value in
     * @param $value mixed The value to be stored
     */
    public function save($key, $value) {
        $_SESSION[$key] = $value;
    }
}