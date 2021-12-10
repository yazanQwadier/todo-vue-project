<?php
namespace App\classes\auth;

use App\services\RegisterService;

class Register {
    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

        $this->register();
    }

    public function register(){
        $register = new RegisterService();

        $data = ['username' => $this->username, 'email' => $this->email, 'password' => $this->password];
        // check if all parameters are validated
        $errors = $register->validate($data);

        if( count($errors) > 0 ){
            echo json_encode( ["status" => "failed", "type" => "validate", "response" => $errors]);
            exit;
        }

        // check if there are accounts use this email
        $is_exists = $register->checkExistsUser($data['email']);
        if( $is_exists != null ){
            echo json_encode( ["status" => "failed", "type" => "exists", "response" => "There is really Account uses this email !!"]);
            exit;
        }

        $user = $register->insert($data);
        if( $user != null ){
            echo json_encode( ["status" => "success", "response" => $user]);
        }
        else{
            echo json_encode( ["status" => "failed", "type" => "unknown", "response" => "There are problem !"]);
            exit;
        }
    }
    
}


?>