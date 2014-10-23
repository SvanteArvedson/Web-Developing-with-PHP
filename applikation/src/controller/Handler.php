<?php

namespace controller;

require_once dirname(__FILE__) . '/../view/Navigation.php';
require_once dirname(__FILE__) . '/../model/Session.php';

/**
 * Base class for all handler classes
 */
class Handler {
    
    /**
     * @var $navigation \view\Navigation
     */
    protected $navigation;
    
    /**
     * @var $session \view\Session
     */
    protected $session;

    /**
     * @param $signature String Signature is request IP and browser, to prevent session steeling
     */
    public function __construct($signature) {
        $this -> navigation = new \view\Navigation();
        $this -> session = new \model\Session($signature);
    }
}