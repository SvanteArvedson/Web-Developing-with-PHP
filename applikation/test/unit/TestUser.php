<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/User.php';

class TestUser implements iTest {
    
    public function run() {
        
        // test 1
        $id = 1;
        $username = 'string';
        $password = 'string';
        $salt = '_asdfasdf';
        $privileges = 'Student';

        try {
            $user = new \model\User($id, $username, $password, $salt, $privileges);
        } catch (\Exception $e) {
            throw new Exception("Test 1 not passed");
        }
        
        echo "<p>All test for User.php done!</p>";
    }
}