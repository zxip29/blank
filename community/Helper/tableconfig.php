<?php
namespace Community\Helper;

require __DIR__.'/../Vendor/autoload.php';

use Connection\Get\Database;

class Tableconfig {
    private $conn;

    public function __construct(){
        $this->conn = (new Database()) -> getConnection();
        $this->initializelogic();
    }

    private function initializelogic() {
        $this->userauth();
    }

    private function creationmethod($stru) {
        $this->conn->query($stru);
    }

    private function userauth() {
        $users = "CREATE TABLE IF NOT EXISTS users (
            userid INT(11) NOT NULL,
            userprivate INT(11) NOT NULL,
            username VARCHAR(255) NOT NULL,
            device VARCHAR(255) NOT NULL,
            status TEXT NOT NULL,
            creation VARCHAR(255) NOT NULL,
            plan VARCHAR(255) NOT NULL,
            profile VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";

        $this->creationmethod($users);
    }
}

$data = new Tableconfig();
?>