<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/User.php';
require_once dirname(__FILE__).'/../../src/model/Privileges.php';

class TestUserFactory implements iTest {
    
    public function run() {
        $factory = new \model\UserFactory();    
        $id = 1;
        $username = "Student";
        $password = "Lösenord";
        $salt = "_asdfghjk";
        $privileges = \model\Privileges::STUDENT;
        
        // test 1
        try {
            $user = $factory -> recreateUser("", $password);
            assert(false);
        } catch(\InvalidArgumentException $e) {
            // test 1 passed
        }
        
        // test 2
        try {
            $user = $factory -> recreateUser($username, "");
            assert(false);            
        } catch (\InvalidArgumentException $e) {
            // test 2 passed
        }
        
        // test 3
        try {
            $user = $factory -> recreateUser($username, "wrongPassword");
            assert(false);            
        } catch (\Exception $e) {
            // test 2 passed
        }
        
        // test 4
        $user = $factory -> recreateUser($username, $password);
        assert(get_class($user) === 'model\User');
        
        // test 5
        $user = $factory -> createUser($id, $username, $password, $salt, $privileges);
        assert(get_class($user) === 'model\User');
    }
}