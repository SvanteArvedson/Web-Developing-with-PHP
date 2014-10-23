<?php

namespace controller;

require_once dirname(__FILE__) . '/../controller/Handler.php';
require_once dirname(__FILE__) . '/../view/FrontPage.php';
require_once dirname(__FILE__) . '/../model/UserFactory.php';
require_once dirname(__FILE__) . '/../model/User.php';

/**
 * Controller object for login and logout
 */
class AuthenticationHandler extends Handler {
    
    /**
     * @var $frontPage \view\FrontPage
     */
    private $frontPage;

    public function __construct() {
        $this -> frontPage = new \view\FrontPage();
        parent::__construct($this -> frontPage -> getSignature());
    }

    /**
     * Called when URL is index.php?action=login
     */
    public function doLogin() {
        $uf = new \model\UserFactory();        
        if ($this -> frontPage -> isPostback() && !$this -> session -> isUserAuthenticated()) {
            try {
                $inputs = $this -> frontPage -> getInputs();
                $user = $uf -> recreateUser($inputs[\view\FrontPage::$nameUsername], $inputs[\view\FrontPage::$namePassword]);
                $this -> session -> loginUser($user);
            } catch (\Exception $e) {
                if ($e -> getCode() != -1) {
                    $this -> frontPage -> saveProvidedUsername();
                    $this -> frontPage -> createErrorMessage($e -> getCode());
                } else {
                    //TODO: show a custom error page here
                    var_dump($e);
                    die();
                }
            }
        }
        $this -> navigation -> redirectToFrontPage();
    }

    /**
     * Called when URL is index.php?action=logout
     */
    public function doLogout() {
        if ($this -> session -> isUserAuthenticated()) {
            $this -> session -> logoutUser();
        }
        $this -> navigation -> redirectToFrontPage();
    }
    
    /**
     * Called when URL is index.php
     */
    public function createFrontPage() {
        if ($this -> frontPage -> isPostback()) {
            $this -> navigation -> redirectToFrontPage();
        } else {
            if ($this -> session -> isUserAuthenticated()) {
                $user = $this -> session -> getValue(\model\Session::$keyUser);
                $this -> frontPage -> echoFrontPage($user);
            } else {
                $this -> frontPage -> echoLoginPage();
            }
        }
    }

}
