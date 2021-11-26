<?php
namespace App\services;

require './bootstrap.php';
use App\db\Connection;

class TasksService {

    public function get($request){
        $connection = Connection::getInstance();
        $sql = "SELECT tasks.*, priorities.priority AS priority_order,priorities.name AS priority_name, priorities.color FROM tasks ".
                "LEFT JOIN priorities ON tasks.priority_id = priorities.id WHERE tasks.user_id=".$request['user_id']."";
        $result = $connection->query($sql);
        
        $tasks = [];
        while($task = $result->fetch_assoc()){
            $tasks[ $task['category_id'] ][] = $task;
        }

        echo json_encode($tasks);
    }

    public function insert($data){
        $connection = Connection::getInstance();

        $sql = $connection->prepare( "INSERT INTO tasks (user_id, category_id, priority_id, content, created_at) VALUES (?, ?, ?, ?, ?)" );
        $time = date("Y-m-d h:i:s", time());
        $sql->bind_param( "iiiss", $data['user_id'], $data['category_id'], $data['priority_id'], $data['content'], $time );
        $sql->execute();
        $task = $this->task($sql->insert_id);
        $sql->close();

        return json_encode(['status' => true, 'task' => $task]);
    }

    public function update($task_id, $data){
        $connection = Connection::getInstance();

        $sql = $connection->prepare( "UPDATE tasks SET priority_id=?, content=?, updated_at=? WHERE id=?" );
        $time = date("Y-m-d h:i:s", time());
        $sql->bind_param( "issi", $data['priority_id'], $data['content'], $time, $task_id);
        $sql->execute();
        $task = $this->task($task_id);
        $sql->close();

        return json_encode(['status' => true, 'task' => $task]);
    }

    public function delete($task_id){
        $sql = "DELETE FROM tasks WHERE id=$task_id";
        $connection = Connection::getInstance();
        $result = $connection->query($sql);

        if( $result ){
            return json_encode(['status' => true]);
        }
        return json_encode(['status' => false]);
    }


    public function changeTaskDone($task_id, $has_done){
        $connection = Connection::getInstance();
        $sql = $connection->prepare( "UPDATE tasks SET has_done=?, updated_at=? WHERE id=?" );
        $time = date("Y-m-d h:i:s", time());
        $sql->bind_param( "isi", $has_done, $time, $task_id);
        $sql->execute();
        $task = $this->task($task_id);
        $sql->close();
        return json_encode(['status' => true, 'task' => $task]);
    }

    public function task($id){
        $connection = Connection::getInstance();
        $sql = "SELECT tasks.*, priorities.priority AS priority_order,priorities.name AS priority_name, priorities.color FROM tasks ".
                "LEFT JOIN priorities ON tasks.priority_id = priorities.id WHERE tasks.id=$id";
        
        $result = $connection->query($sql);
        return $result->fetch_assoc();
    }

}

?>