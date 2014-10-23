<?php

namespace view;

require_once dirname(__FILE__) . '/Page.php';

/**
 * Class for presenting statistics for quiz results
 */
class StatisticsPage extends Page {
    
    /**
     * Creates response for URL index.php?action=showStatistics
     * 
     * @param $user \model\User
     * @param $statistics \model\Statistics
     * @param $courses An array of \model\Course objects
     */
    public function echoStatistics(\model\User $user, \model\Statistics $statistics, $courses) {
        // Admin, teacher and student gets different response
        if ($user -> getPrivileges() == \model\Privileges::ADMIN) {
            $title = "QuizApp - Alla kursresultat";
            include(dirname(__FILE__) . '/templates/adminStatistics.php');
        } else if ($user -> getPrivileges() == \model\Privileges::TEACHER) {
            $title = "QuizApp - Kursresultat";
            include(dirname(__FILE__) . '/templates/teacherStatistics.php');
        } else {
            $title = "QuizApp - Mina resultat";
            include(dirname(__FILE__) . '/templates/studentStatistics.php');
        }
    }
}