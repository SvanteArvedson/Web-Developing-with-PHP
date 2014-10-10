<?php

namespace view;

class Navigation {
    
    public function redirectToFrontPage() {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die();
    }

}