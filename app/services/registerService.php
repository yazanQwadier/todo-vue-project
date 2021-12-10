<?php
namespace App\services;

use App\db\Connection;

class RegisterService {

    public function validate($data){
        $errors = [];

        if( strlen($data['username']) > 10 || strlen($data['username']) < 3 ){
            $errors[] = "Username must be from 3 to 10 characters !";
        }
        
        if( !filter_var($data['email'], FILTER_VALIDATE_EMAIL ) ){
            $errors[] = "Email must be as Email theme, not as a text !";
        }

        if( strlen($data['password']) < 6 ){
            $errors[] = "Password must be greater than 6 digits !";
        }
        
        return $errors;
    }


    public function checkExistsUser($email){
        $connection = Connection::getInstance();

        $result = $connection->query('SELECT * FROM users WHERE email="'.$email.'"');
        if( $result->num_rows > 0 ){
            return $result->fetch_assoc();
        }

        return null;
    }

    public function insert($data){
        $connection = Connection::getInstance();

        $encryptPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = $connection->prepare( "INSERT INTO users (username, email, password) VALUES ( ?, ?, ? ) ");
        $sql->bind_param( "sss", $data['username'], $data['email'], $encryptPassword );
        $sql->execute();
        $sql->close();

        return $this->checkExistsUser($data['email']);
    }
}

?>