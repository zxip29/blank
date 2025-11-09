<?php
namespace Connection\Get;

use mysqli;

class Database {
    public $conn;

    public function __construct() {
        $config = require __DIR__.'/../Config/config.php';
        $this->conn = new mysqli(
            $config['localhost'],
            $config['username'],
            $config['password'],
            $config['databasename']
        );
        $this->setupTable();
    }

    public function getConnection() {
        return $this->conn;
    }
    
    private function setupTable() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            userid INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            userprivate VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            device VARCHAR(255) NOT NULL,
            status VARCHAR(255) NOT NULL,
            creation VARCHAR(255) NOT NULL,
            plan VARCHAR(255) NOT NULL,
            profile VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        );";
        
        mysqli_query($this->conn, $sql);
    }
}
?>