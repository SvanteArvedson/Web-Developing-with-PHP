<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

class QuizPage extends Page {
    
    public static $keyQuizId = 'quiz';
    public static $idQuiz = 'quizId';
    
    public function createErrorMessage($errorCode) {
        switch ($errorCode) {
            case \model\ErrorCode::NO_PRIVILEGES :
                $this -> addErrorMessage("Du har inte behörgihet att se den begärda sidan");
                break;
            case \model\ErrorCode::QUIZ_DONT_EXISTS :
                $this -> addErrorMessage("Det efterfrågade quizet existerar inte");
                break;
            case \model\ErrorCode::ACTION_IMPOSSIBLE :
                $this -> addErrorMessage("Du kan inte göra detta just nu");
                break;
            case \model\ErrorCode::ANSWERS_MISSING :
                $this -> addErrorMessage("Svara på samtliga frågor innan du skickar in");
                break;
        }
    }
    
    public function getInputs() {
        return $_POST;
    }
    
    public function getUrlParameters() {
        return array(self::$keyQuizId => $_GET[self::$keyQuizId]);
    }
    
    public function echoDoQuiz(\model\User $user, \model\Quiz $quiz) {
        $title = "QuizApp - " . $quiz -> getTitle();
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        include (dirname(__FILE__) . '/templates/doQuiz.php');
    }

    public function echoQuizResult($user, $score, $quiz, $answers) {
        $title = "QuizApp - resultat " . $quiz -> getTitle();
        include(dirname(__FILE__) . '/templates/quizResult.php');
    }
}