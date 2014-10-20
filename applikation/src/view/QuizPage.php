<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

class QuizPage extends Page {
    
    public static $keyQuizId = 'quiz';
    
    public function getUrlParameters() {
        return array(self::$keyQuizId => $_GET[self::$keyQuizId]);
    }
    
    public function echoDoQuiz(\model\User $user, \model\Quiz $quiz) {
        echo "Metoden fungerar! (\\view\\QuizPage::echoDoQuiz)";
        var_dump($user);
        var_dump($quiz);
    }
}