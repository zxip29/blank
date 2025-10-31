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
        echo "hello world";
    }

    private function creationmethod($stru) {
        $this->conn->query($stru);
    }
}

$data = new Tableconfig();
?>