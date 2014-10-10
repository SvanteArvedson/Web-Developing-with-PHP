<?php

namespace model;

require_once dirname(__FILE__) . '/UserFactory.php';

class UserRepository {
    
    public function getUserByUsername($username) {
        // For testing, schould be connected with a database
        if ($username !== 'Lovisa') {
            return null;    
        } else {
            return UserFactory::createUser('Lovisa', 'Lösenord');    
        }
    }
    
}