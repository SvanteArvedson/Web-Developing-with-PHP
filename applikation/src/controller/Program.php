<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/Page.php';
require_once dirname(__FILE__) . '/../view/Action.php';
require_once dirname(__FILE__) . '/../controller/AuthenticationHandler.php';

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
            default :
                echo "Fel URL, ingen action matchas";
        }
    }
}