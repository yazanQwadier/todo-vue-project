<?php

namespace App\classes;

use \App\services\TasksService;

class Task {

    public function insert($request){
        $tasks = new TasksService();
        $data = [
            'user_id' => $request['user_id'],
            'category_id' => $request['category_id'],
            'content' => $request['content'],
            'priority_id' => $request['priority_id'],
        ];
        return $tasks->insert($data);
    }

    public function get($request){
        $tasks = new TasksService();
        $data = [
            'user_id' => $request['user_id'],
        ];
        return $tasks->get($data);
    }

    public function update($request){
        $tasks = new TasksService();
        $task_id = $request['task_id'];

        $data = [
            'user_id' => $request['user_id'],
            'content' => $request['content'],
            'priority_id' => $request['priority_id'],
        ];
        return $tasks->update($task_id, $data);
    }

    public function delete($request){
        $tasks = new TasksService();
        $task_id = $request['task_id'];
        return $tasks->delete($task_id);
    }

    public function changeTaskDone($request){
        $tasks = new TasksService();
        $task_id = $request['task_id'];
        $has_done = $request['has_done'];
        return $tasks->changeTaskDone($task_id, $has_done);
    }

    public function task($request){
        $tasks = new TasksService();
        $task_id = $request['task_id'];
        return $tasks->task($task_id);
    }
}


?>