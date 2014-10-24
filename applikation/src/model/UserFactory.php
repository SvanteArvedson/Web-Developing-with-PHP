<?php

namespace model;

require_once dirname(__FILE__) . '/User.php';
require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/ErrorCode.php';

/**
 * Create User-objects
 */
class UserFactory {

    /**
     * Checks and recreate an existing user if credentials are correct
     * 
     * @param $username String
     * @param $password String
     */
    public function recreateUser($username, $password) {
        if ($username === '') {
            throw new \InvalidArgumentException('$username can\'t be empty', ErrorCode::USERNAME_EMPTY);
        }
        if ($password === '') {
            throw new \InvalidArgumentException('$password can\'t be empty', ErrorCode::PASSWORD_EMPTY);
        }

        try {
            $repo = new UserRepository();
            $user = $repo -> getUserByUsername($username);

            if ($user === null || $user -> getPassword() !== crypt($password, $user -> getSalt())) {
                throw new \Exception("No user exists with username $username and password $password", ErrorCode::NO_MATCHING_USER);
            }
            return $user;
            
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new user object
     * 
     * @param $id int
     * @param $username string
     * @param $password string
     * @param $salt string 
     * @param $privileges string
     * 
     * @return \model\User A user object
     */
    public function createUser($id, $username, $password, $salt, $privileges) {
        return new User($id, $username, $password, $salt, $privileges);
    }
}