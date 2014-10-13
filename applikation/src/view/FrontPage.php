<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

/**
 * Front page shows log in form or the start page for a logged in user
 * @author Svante Arvedson
 */
class FrontPage extends Page {

    private static $keyProvidedUsername = 'providedUsername';
    public static $nameForm = 'loginform';
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
        $providedUsername =  $this->cookie->cookieIsset(self::$keyProvidedUsername) ? $this->cookie->loadOnce(self::$keyProvidedUsername) : "";
        include (dirname(__FILE__) . '/templates/loginForm.php');
    }

    public function echoFrontPage($user) {
        $title = "AppQuiz - Startsida";
        
        switch ($user->getPrivileges()) {
            case \model\Privileges::STUDENT :
                include (dirname(__FILE__) . '/templates/frontPageStudent.php');
                break;
            case \model\Privileges::TEACHER :
                include (dirname(__FILE__) . '/templates/frontPageTeacher.php');
                break;
            case \model\Privileges::ADMIN :
                include (dirname(__FILE__) . '/templates/frontPageAdmin.php');
                break;
        }
    }

    public function saveProvidedUsername() {
        $this->cookie->save(self::$keyProvidedUsername, $_POST[self::$nameUsername]);
    }
}
