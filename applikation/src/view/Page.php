<?php

namespace view;

require_once dirname(__FILE__) . '/Cookie.php';

/**
 * Base class for all Page-objects in the application
 * @author Svante Arvedson
 */
class Page {

    /**
     * @var $keyErrorMessage String Key for storing error message in cookie
     */
    protected static $keyErrorMessage = "Page::ErrorMessage";
    
    /**
     * @var $keySuccessMessage String Key for storing success message in cookie
     */
    protected static $keySuccessMessage = "Page::SuccessMessage";
    
    /**
     * @var $cookie view\Cookie
     */
    protected $cookie;

    public function __construct() {
        $this -> cookie = new Cookie();
    }

    /**
     * Checks if request method is POST
     * 
     * @return bool TRUE if request method i POST
     */
    public function isPostBack() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @return String Return content in URL action parameter
     */
    public function getAction() {
        return isset($_GET[Action::KEY]) ? $_GET[Action::KEY] : "";
    }

    /**
     * @return array A copy of $_POST
     */
    public function getInputs() {
        return $_POST;
    }

    /**
     * @return String Request signature [IP and Browser], to prevent session steeling
     */
    public function getSignature() {
        return $_SERVER['REMOTE_ADDR'] . ";" . $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Saves an error message in a cookie
     * 
     * @param $errorMessage String The error message to be saved
     */
    protected function addErrorMessage($errorMessage) {
        $this->cookie->save(self::$keyErrorMessage, $errorMessage);
    }

    /**
     * Saves an success message in a cookie
     * 
     * @param $successMessage String The success message to be saved
     */
    protected function addSuccessMessage($successMessage) {
        $this->cookie->save(self::$keySuccessMessage, $successMessage);
    }
}