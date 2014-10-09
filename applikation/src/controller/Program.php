<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/Route.php';
require_once dirname(__FILE__) . '/../view/RouteHandler.php';
require_once dirname(__FILE__) . '/../view/Action.php';

class Program {
    
    private $routeHandler;
    
    public function __construct() {
        $this->routeHandler = new \view\RouteHandler();
    }
    
    public function run() {
        $route = $this->routeHandler->getRoute();
        
        // Ignore warnings beacuse we check for null value
        switch ($route->getAction()) {
            case '':
                echo "Visa startsidan";
                break;
            default:
                echo "Fel URL, ingen action matchas";
        }
    }
}
