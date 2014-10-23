<?php

namespace view;

/**
 * Handles redirects
 */
class Navigation {
    
    /**
     * Redirect user to index.php
     */
    public function redirectToFrontPage() {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die();
    }
    
    /**
     * Redirect user to index.php?action=showCourses
     */
    public function redirectToShowCourses() {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::SHOW_COURSES);
        die();
    }

    /**
     * Redirect user to index.php?action=showCourse&course=__
     */
    public function redirectToShowCourse($courseId) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::SHOW_COURSE . "&" . CoursePage::$keyCourseId . "=" . $courseId);
        die();
    }

    /**
     * Redirect user to index.php?action=editCourse&course=__
     */
    public function redirectToEditCourse($courseId) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::EDIT_COURSE . "&" . CoursePage::$keyCourseId . "=" . $courseId);
        die();
    }

    /**
     * Redirect user to index.php?action=showResult
     */
    public function redirectToShowQuizResult() {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::SHOW_QUIZ_RESULT);
        die();
    }

    /**
     * Redirect user to index.php?action=doQuiz&quiz=__
     */
    public function redirectToDoQuiz($quizId) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::DO_QUIZ . "&" . QuizPage::$keyQuizId . "=" . $quizId);
        die();
    }
}