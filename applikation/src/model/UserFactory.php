<?php

namespace model;

require_once dirname(__FILE__) . '/UserRepository.php';
require_once dirname(__FILE__) . '/ErrorCode.php';

class UserFactory {

    public static function recreateUser($username, $password) {
        $repo = new UserRepository();

        if ($username === '') {
            throw new \InvalidArgumentException('$username can\'t be empty', ErrorCode::USERNAME_EMPTY);
        }
        if ($password === '') {
            throw new \InvalidArgumentException('$password can\'t be empty', ErrorCode::PASSWORD_EMPTY);
        }

        try {
            $user = $repo -> getUserByUsername($username);
            if ($user === null || $user -> getPassword() !== $password) {
                throw new \Exception("No user exists with username $username and password $password", ErrorCode::NO_MATCHING_USER);
            }
        } catch(\Exception $e) {
            throw $e;
        }

        return new User($username, $password);
    }

    public static function createUser($username, $password) {
        return new User($username, $password);
    }

}
