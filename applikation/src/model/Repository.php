<?php

namespace model;

require_once dirname(__FILE__).'/../settings/DatabaseSettings.php';

/**
 * Base class for repository-classes
 * @author Svante Arvedson
 */
class Repository {
    
    protected $connection;
    protected $table;
    
    protected function getConnection() {
        if ($this->connection === null) {
            $this->connection = new \PDO(\DatabaseSettings::CONNECTION_STRING, \DatabaseSettings::USERNAME, \DatabaseSettings::PASSWORD);
        }
        
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        return $this->connection;
    }
}
