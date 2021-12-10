<?php
namespace App\classes\auth;

use App\services\LoginService;

class Login {
    public $email;
    public $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;

        $this->login();
    }

    public function login(){
        $login = new LoginService();
        $data = ["email" => $this->email, "password" => $this->password];
        $user = $login->checkUserData($data);

        switch($user){
            case "invalid-password": 
                echo json_encode(["status" => "failed", "response" => "invalid password"]); break;
            case "no-user": 
                echo json_encode(["status" => "failed", "response" => "no there user"]); break;
            default:
                echo json_encode(["status" => "success", "response" => $user]);  break;
        }
        exit;
    }
}

?>