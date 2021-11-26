<?php
namespace App\services;

require './bootstrap.php';
use App\db\Connection;

class PrioritiesService {

    public function all(){
        $connection = Connection::getInstance();
        $sql = "SELECT * FROM priorities";
        $result = $connection->query($sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return json_encode($data);
    }

}

?>