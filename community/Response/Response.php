<?php
namespace Response;
require __DIR__.'/../Vendor/autoload.php';

use Connection\Get\Database;
class Response {
    private $conn;

    public function __construct() {
        $this->conn = (new Database()) ->getConnection();
    }

    public function sendresponsebody($data) {
        echo json_encode($data);
        header('Content-Type: application/json');

        http_response_code($data['status']);
        mysqli_close($this->conn);
        exit();
    }

    public function sendresponseheader() {
        
    }
} 
?>