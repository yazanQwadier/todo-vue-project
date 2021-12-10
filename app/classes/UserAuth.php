<?php

namespace App\classes;

use App\classes\auth\Login;
use App\classes\auth\Register;

class UserAuth {

    public function singUp($request){
        $username = $request['username'];
        $email = $request['email'];
        $password = $request['password'];
        return new Register($username, $email, $password);
    }

    public function login($request){
        $email = $request['email'];
        $password = $request['password'];
        return new Login($email, $password);
    }

}

?>