<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

/**
 * Class for presenting quiz and quiz forms
 */
class QuizPage extends Page {
    
    /**
     * @var $keyQuizId String Key for storing quizId in URL
     */
    public static $keyQuizId = 'quiz';
    
    /**
     * @var $idQuiz String
     */
    public static $idQuiz = 'quizId';
    
    /**
     * Creates an error message and saves the message in a cookie
     * 
     * @param $errorCode integer
     */
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
    
    /**
     * Gets the content saved in URL
     */
    public function getUrlParameters() {
        return array(self::$keyQuizId => $_GET[self::$keyQuizId]);
    }
    
    /**
     * Creates a form for answering a quiz
     * 
     * @param $user \model\User
     * @param $quiz \model\Quiz
     */
    public function echoDoQuiz(\model\User $user, \model\Quiz $quiz) {
        $title = "QuizApp - " . $quiz -> getTitle();
        $errorMessage = $this -> cookie -> cookieIsset(self::$keyErrorMessage) ? $this -> cookie -> loadOnce(self::$keyErrorMessage) : null;
        include (dirname(__FILE__) . '/templates/doQuiz.php');
    }

    /**
     * Presents result answered quiz
     * 
     * @param $user \model\User
     * @param $score integer Users score
     * @param $quiz \model\Quiz
     * @param $answers array An array with the given quiz answers
     */
    public function echoQuizResult(\model\User $user, $score, \model\Quiz $quiz, $answers) {
        $title = "QuizApp - resultat " . $quiz -> getTitle();
        include(dirname(__FILE__) . '/templates/quizResult.php');
    }
}