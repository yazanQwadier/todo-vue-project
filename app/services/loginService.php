<?php
namespace App\services;

use App\db\Connection;

class LoginService {

    public function checkUserData($data){
        $sql = "SELECT * FROM users WHERE email='".$data['email']."' LIMIT 1";

        $connection = Connection::getInstance();
        $result = $connection->query( $sql );

        if( $result->num_rows > 0 ){
            $user = $result->fetch_assoc();

            if( password_verify($data['password'], $user['password']) ){
                return $user;
            }
            else{
                return "invalid-password";
            }
        }

        return "no-user";
    }

}

?>