<?php
require __DIR__.'/Vendor/autoload.php';

use Usermodels\V1\Usercontrollers\User;

class Index {
    public $user;

    public function __construct(){
        $this->user = new User();
    }

    public static function errorlog($data) {
        echo json_encode($data);
        header('Content-Type: application/json');

        http_response_code($data['status']);
        exit();
    }

    public function manage($data) {
        switch($data->request) {
            case '1000':
                $this->user->usercreation($data);
            break;
            case '2000':
                $this->user->authorized($data);
            break;
            case '3000':
                $this->user->authorization($data);
            break;
            default:
                self::errorlog(
                    [
                        "status"=>"402",
                        "message"=>"Unauthorized not found"
                    ]
                );
            break;
        }
    }
}

$get = file_get_contents('php://input');
if(empty($get)) {
    Index::errorlog(
        [
            "status"=>"401",
            "message"=>"Unauthorized not found"
        ]
    );
}

$decode = json_decode($get);

$data = new Index();
$data -> manage($decode);

?>