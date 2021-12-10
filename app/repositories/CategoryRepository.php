<?php
namespace App\repositories;

use App\db\Connection;

class CategoryRepository {

    public function all(){
        $sql = "SELECT * FROM tasks_categories";
        $connection = Connection::getInstance();
        $result = $connection->query($sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return json_encode($rows);
    }
}

?>