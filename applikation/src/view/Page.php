<?php

namespace view;

require_once dirname(__FILE__) . '/Cookie.php';

/**
 * Base class for all Page-objects in the application
 * @author Svante Arvedson
 */
class Page {

    protected static $keyErrorMessage = "Page::ErrorMessage";
    protected $cookie;

    public function __construct() {
        $this -> cookie = new Cookie();
    }

    public function isPostBack() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getAction() {
        return isset($_GET[Action::KEY]) ? $_GET[Action::KEY] : "";
    }

    public function getSignature() {
        return $_SERVER['REMOTE_ADDR'] . ";" . $_SERVER['HTTP_USER_AGENT'];
    }

    protected function addErrorMessage($errorMessage) {
        $this->cookie->save(self::$keyErrorMessage, $errorMessage);
    }
}
