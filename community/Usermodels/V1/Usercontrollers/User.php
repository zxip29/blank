<?php

namespace Usermodels\V1\Usercontrollers;

require __DIR__.'/../../../Vendor/autoload.php';

use Connection\Get\Database;
use Response\Response;
class User {
    private $conn;
    private $response;
    private $config;

    public function __construct() {
        $this->conn = (new Database()) -> getConnection();
        $this->response = new Response();
        $this->config = require __DIR__.'/../../../Config/config.php';
    }

    private function checkuser($columname, $value) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE $columname=?");
        $stmt -> bind_param("s", $value);
        $stmt -> execute();
        $res = $stmt -> get_result();
        if($res -> num_rows > 0) {
            return true;
        }

        return false;
    }

    private function userinfo($userprivate) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userprivate");
        $stmt -> bind_param("s", $userprivate);
        $stmt -> execute();

        $res = $stmt -> get_result();

        if($res -> num_rows == 0) {
            $this->response->sendresponsebody(
                [
                    "status"=>"401"
                ]
            );
        }

        $row = $res -> fetch_assoc();

        return [
            "username"=>$row['username'],
            "profile"=>$row['profile'],
            "device"=>$row['device'],
            "accountstatus"=>$row['status'],
            "plan"=>$row['plan'],
            "userprivate"=>$row['userprivate']
        ];
    }

    private function freeplan($userinfo) {
        $userinfo['status'] = "200";
        unset($userinfo['device']);
        unset($userinfo['plan']);
        unset($userinfo['userprivate']);
        $this->response->sendresponsebody($userinfo);
    }

    private function normalplan($userinfo) {

    }

    private function specialplan($userinfo) {

    }

    public  function usercreation($data) {
        $userprivate = bin2hex(openssl_random_pseudo_bytes(124));
        $username = $data->username ?? '';
        $email = $data->email ?? '';
        $device = $data->device ?? '';
        $status = true;
        $creation = date('Y/M/d');
        $plan = "1000";
        $profile = $this->config['profile'].$data->profile;
        $password = password_hash($data->password, PASSWORD_BCRYPT);

        if($this->checkuser("email", $email)) {
            $this->response->sendresponsebody(
                [
                    "status"=>"401"
                ]
            );
        }

        if($this->checkuser("device", $device)) {
            $this->response->sendresponsebody(
                [
                    "status"=>"402"
                ]
            );
        }

        $stmt = $this->conn->prepare("INSERT INTO users (userprivate, username, email, device, status, creation, plan, profile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt -> bind_param("sssssssss", $userprivate, $username, $email, $device, $status, $creation, $plan, $profile, $password);
        $stmt -> execute();

        $this->response->sendresponsebody(
            [
                "status"=>"200",
                "userprivate"=>$userprivate
            ]
        );
    }

    public function authorized($data) {
        $userinfo = $this->userinfo($data->userprivate);

        if(!$userinfo['status']) {
            $this->response->sendresponsebody(
                [
                    "status"=>"402"
                ]
            );
        }

        if($userinfo['device'] !== $data->device) {
            $this->response->sendresponsebody(
                [
                    "status"=>"403"
                ]
            );
        }

        switch($userinfo['plan']) {
            case '1000':
                $this->freeplan($userinfo);
            break;
            case '200':
                $this->normalplan($userinfo);
            break;
            case '3000':
                $this->specialplan($userinfo);
            break;
        }
    }

}
?>