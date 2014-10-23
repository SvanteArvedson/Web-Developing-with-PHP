<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';
require_once dirname(__FILE__) . '/../model/Privileges.php';

/**
 * Front page shows log in form or the start page for a logged in user
 */
class FrontPage extends Page {
    
    /**
     * @var $keyProvidedUsername String Key for saving the provided username
     */
    private static $keyProvidedUsername = 'providedUsername';
    
    /**
     * @var $nameForm String Name attribute for loginform
     */
    public static $nameForm = 'loginform';
    
    /**
     * @var $nameUsername String Name attribute for username field
     */
    public static $nameUsername = 'username';
    
    /**
     * @var $namePassword String Name attribute for password field
     */
    public static $namePassword = 'password';

    /**
     * Creates an error message and saves it in a cookie
     * 
     * @param $errorCode integer
     */
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

    /**
     * Creates and shows a login form
     */
    public function echoLoginPage() {
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        $title = "QuizApp - Logga in";
        $providedUsername =  $this->cookie->cookieIsset(self::$keyProvidedUsername) ? $this->cookie->loadOnce(self::$keyProvidedUsername) : "";
        include (dirname(__FILE__) . '/templates/loginForm.php');
    }

    /**
     * Creates and shows a front page for a logged in user
     * 
     * @param $user \model\User
     */
    public function echoFrontPage(\model\User $user) {
        $title = "QuizApp - Startsida";
        
        // Admin, teachers and students gets different pages
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

    /**
     * Saves the provided username in a cookie
     */
    public function saveProvidedUsername() {
        $this->cookie->save(self::$keyProvidedUsername, $_POST[self::$nameUsername]);
    }
}
