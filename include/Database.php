<?php

/**
 * Description of Database
 *
 * @author Matt
 */
class Database {
    private $sql;
    
    public function __construct($host, $user, $password, $database ) {
        $this->sql = new mysqli($host, $user, $password, $database);
    }
    
    public function getRecord($key) {
        $statement = $this->sql->prepare(
                'select uri from url_map where `key` = ? limit 1'
            );
        if ( $statement !== FALSE ){
            $statement->bind_param('s', $key);
            $statement->execute();
            $statement->store_result();
            $statement->bind_result($uri);
            $statement->fetch();
            return $uri;
        }
        return "";
    }
    
    public function setRecord($key, $uri) {
        $statement = $this->sql->prepare(
                'insert into url_map (`key`, `uri`) values (?, ?)'
            );
        if ( $statement !== FALSE ){
            $statement->bind_param('ss', $key, $uri);
            return $statement->execute();
        }
        return FALSE;
    }
}
