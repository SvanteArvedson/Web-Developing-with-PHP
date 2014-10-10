<?php

namespace view;

require_once dirname(__FILE__) . '/Cookie.php';

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

    protected function addErrorMessage($errorMessage) {
        $this->cookie->save(self::$keyErrorMessage, $errorMessage);
    }
}
