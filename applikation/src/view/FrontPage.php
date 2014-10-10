<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

class FrontPage extends Page {

    public static $nameUsername = 'username';
    public static $namePassword = 'password';

    public function createErrorMessage($errorCode) {
        switch ($errorCode) {
            case \model\ErrorCode::USERNAME_EMPTY :
                $errorMessage = "Användarnamn saknas";
                break;
            case \model\ErrorCode::PASSWORD_EMPTY :
                $errorMessage = "Lösenord saknas";
                break;
            case \model\ErrorCode::NO_MATCHING_USER :
                $errorMessage = "Felaktigt användarnamn och/eller lösenord";
                break;
        }

        $this -> addErrorMessage($errorMessage);
    }

    public function getInputs() {
        return array(self::$nameUsername => $_POST[self::$nameUsername], self::$namePassword => $_POST[self::$namePassword]);
    }

    public function echoLoginPage() {
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        $title = "AppQuiz - Logga in";
        include (dirname(__FILE__) . '/templates/loginForm.php');
    }

    public function echoFrontPage($user) {
        $title = "AppQuiz - Startsida";
        include (dirname(__FILE__) . '/templates/frontPage.php');
    }

}
