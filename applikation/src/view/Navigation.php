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

}