<?php
namespace App\db;

use mysqli;

class Connection {
    private static $connection = null;
    private static $instance = null;

    public static $servername = "localhost";
    public static $username = "root";
    public static $password = "";
    public static $database = "todoDB";

    public static function getInstance(){
        if( self::$connection == null ){
            self::$instance = new Connection();
            self::$connection = self::$instance->connect();
        }
        return self::$connection;
    }
    
    public function connect(){
        try {
            $connection = new mysqli(
                self::$servername, 
                self::$username, 
                self::$password, 
                self::$database);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } 
            else{
                return $connection;
            }
        } catch (Exception $error) {
            // echo $error->message();
            return null;
        }
    }
    
}

?>