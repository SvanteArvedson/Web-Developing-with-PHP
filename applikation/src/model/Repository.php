<?php

namespace model;

require_once dirname(__FILE__).'/../settings/DatabaseSettings.php';

/**
 * Base class for repository-classes
 */
class Repository {
    
    /**
     * @var $connection \PDO The \PDO object used by the repository objects
     */
    protected $connection;
    
    /**
     * Creats a new \PDO object with a connection string stored in \settings\DatabaseSettings
     * 
     * @return \PDO A \PDO object
     */
    protected function getConnection() {
        // If a connection already exists, that is used
        if ($this->connection === null) {
            $this->connection = new \PDO(\DatabaseSettings::CONNECTION_STRING, \DatabaseSettings::USERNAME, \DatabaseSettings::PASSWORD);
        }

        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->connection;
    }
}
