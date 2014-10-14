<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/Page.php';
require_once dirname(__FILE__) . '/../view/Action.php';
require_once dirname(__FILE__) . '/../controller/AuthenticationHandler.php';
require_once dirname(__FILE__) . '/../controller/CourseHandler.php';

/**
 * Master controller for the application
 * @author Svante Arvedson
 */
class Program {
    public function run() {
        $page = new \view\Page();

        switch ($page->getAction()) {
            case '' :
                $handler = new AuthenticationHandler();
                $handler -> createFrontPage();
                break;
            case \view\Action::LOGIN :
                $handler = new AuthenticationHandler();
                $handler -> doLogin();
                break;
            case \view\Action::LOGOUT :
                $handler = new AuthenticationHandler();
                $handler -> doLogout();
                break;
            case \view\Action::SHOW_COURSE :
                echo "Här kommer det en kurssida såsmåningom";
                break;
            case \view\Action::SHOW_COURSES :
                $handler = new CourseHandler();
                $handler -> showCourses();
                break;
            default :
                //TODO: Custom error page here (404)
                echo "Fel URL, ingen action matchas";
        }
    }
}