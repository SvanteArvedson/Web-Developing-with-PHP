<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

class QuizPage extends Page {
    
    public static $keyQuizId = 'quiz';
    
    public function createErrorMessage($errorCode) {
        switch ($errorCode) {
            case \model\ErrorCode::NO_PRIVILEGES :
                $this -> addErrorMessage("Du har inte behörgihet att se den begärda sidan");
                break;
            case \model\ErrorCode::QUIZ_DONT_EXISTS :
                $this -> addErrorMessage("Det efterfrågade quizet existerar inte");
                break;
        }
    }
    
    public function getUrlParameters() {
        return array(self::$keyQuizId => $_GET[self::$keyQuizId]);
    }
    
    public function echoDoQuiz(\model\User $user, \model\Quiz $quiz) {
        $title = "QuizApp - " . $quiz -> getTitle();
        include (dirname(__FILE__) . '/templates/doQuiz.php');
    }
}