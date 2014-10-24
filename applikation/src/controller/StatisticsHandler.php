<?php

namespace controller;

require_once dirname(__FILE__) . '/../controller/Handler.php';
require_once dirname(__FILE__) . '/../view/StatisticsPage.php';
require_once dirname(__FILE__) . '/../model/StatisticsFactory.php';
require_once dirname(__FILE__) . '/../model/CourseRepository.php';

/**
 * Controller method for statistic functions
 */
class StatisticsHandler extends Handler {
    
    /**
     * @var $statisticsPage \view\StatisticsPage 
     */
    private $statisticsPage;

    public function __construct() {
        $this -> statisticsPage = new \view\StatisticsPage();
        parent::__construct($this -> statisticsPage -> getSignature());
    }

    /**
     * Called when user request URL index.php?action=showStatistics
     */
    public function presentStatistics() {
        if ($this -> session -> isUserAuthenticated()) {
            $user = $this -> session -> getValue(\model\Session::$keyUser);
            $factory = new \model\StatisticsFactory();
            $courseRepo = new \model\CourseRepository();

            // Admin, teachers and students gets different pages
            if ($user -> getPrivileges() == \model\Privileges::ADMIN) {
                $courses = $courseRepo -> getAllCourses();
                $statistics = $factory -> createStatisticsOnAllCourses();
                $this -> statisticsPage -> echoStatistics($user, $statistics, $courses);
            } else if ($user -> getPrivileges() == \model\Privileges::TEACHER) {
                $courses = $courseRepo -> getCoursesWithParticipationBy($user->getId());
                $statistics = $factory -> createStatisticsOnTeacher($user);
                $this -> statisticsPage -> echoStatistics($user, $statistics, $courses);
            } else {
                $courses = $courseRepo -> getCoursesWithParticipationBy($user->getId());
                $statistics = $factory -> createStatisticsOnStudent($user);
                $this -> statisticsPage -> echoStatistics($user, $statistics, $courses);
            }

        } else {
            $this -> navigation -> redirectToFrontPage();
        }
    }
}