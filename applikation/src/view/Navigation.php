<?php

namespace view;

/**
 * Handles redirects
 */
class Navigation {
    
    public function redirectToFrontPage() {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die();
    }
    
    public function redirectToShowCourses() {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?" . Action::KEY . "=" . Action::SHOW_COURSES);
        die();
    }

}