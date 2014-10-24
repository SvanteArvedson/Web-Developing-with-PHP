<?php

namespace test;

require_once dirname(__FILE__).'/../iTest.php';
require_once dirname(__FILE__).'/../../src/model/UserRepository.php';
require_once dirname(__FILE__).'/../../src/model/Privileges.php';

class TestUserRepository implements iTest {
    
    public function run() {
        $repository = new \model\UserRepository();
        
        // test 1
        $username = 'Student';
        $user = $repository -> getUserByUsername($username);        
        assert(get_class($user) === 'model\User');

        $userIds = array(14, 14, 15);
        $users = $repository -> getUsersByIds($userIds);
        // test 2
        assert(is_array($users));
        // test 3
        assert(get_class($users[0]) === 'model\User');

        $courseId = 5;
        $teachers = $repository -> getTeachersOnCourse($courseId);
        // test 4
        assert(is_array($teachers));
        // test 5
        assert(get_class($teachers[0]) === 'model\User');
        // test 6
        assert($teachers[0]->getPrivileges() === \model\Privileges::TEACHER);

        $students = $repository -> getStudentsOnCourse($courseId);
        // test 7
        assert(is_array($students));
        // test 8
        assert(get_class($students[0]) === 'model\User');
        // test 9
        assert($students[0]->getPrivileges() === \model\Privileges::STUDENT);
        
        $teachers = $repository -> getAllTeachers();
        // test 10
        assert(is_array($teachers));
        // test 11
        assert(get_class($teachers[0]) === 'model\User');
        // test 12
        assert($teachers[0]->getPrivileges() === \model\Privileges::TEACHER);
        
        $students = $repository -> getAllStudents();
        // test 13
        assert(is_array($students));
        // test 14
        assert(get_class($students[0]) === 'model\User');
        // test 15
        assert($students[0]->getPrivileges() === \model\Privileges::STUDENT);
    }
}