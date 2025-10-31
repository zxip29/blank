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
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>