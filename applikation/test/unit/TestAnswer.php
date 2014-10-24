<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/Answer.php';

class TestAnswer implements iTest {
    
    public function run() {
        // test 1
        $id = 'string';
        $text = 'string';
        
        try {
            $answer = new \model\Answer($id, $text);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 2
        $id = 1;
        $text = 1;
        
        try {
            $answer = new \model\Answer($id, $text);
        } catch (\InvalidArgumentException $e) {
            // Pass
        }
        
        // test 3
        $id = 1;
        $text = 'string';
        
        try {
            $answer = new \model\Answer($id, $text);
        } catch (\Exception $e) {
            throw new \Exception("Test 3 not passed");
        }
        
        echo "<p>All test for Answer.php done!</p>";
    }    
}