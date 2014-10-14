<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

class CoursePage extends Page {
    
    public function echoListCourses(\model\User $user, $courses) {
        if ($user -> getPrivileges() !== \model\Privileges::ADMIN) {
            $title = "AppQuiz - Mina kurser";
        } else {
            $title = "AppQuiz - Alla kurser";
        }
        
        include (dirname(__FILE__) . '/templates/listCourses.php');
    }
    
}
