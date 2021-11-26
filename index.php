<?php
    require 'bootstrap.php';
    require_once "route.php";
    header('Access-Control-Allow-Origin: *');

    use App\auth\Login;
    use App\auth\Register;
    use App\services\PrioritiesService;
    use \App\services\TasksService;
    use App\services\CategoriesService;

    /* Register all Routes */
    route('/authentication/login', function(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        new Login($email, $password);
    });

    route('/authentication/register', function(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        new Register($username, $email, $password);
    });

    route('/tasks', function(){
        $tasks = new TasksService();
        $data = [
            'user_id' => $_GET['user_id'],
        ];
        echo $tasks->get($data);
    });

    route('/tasks/add', function(){
        $tasks = new TasksService();
        $data = [
            'user_id' => $_POST['user_id'],
            'category_id' => $_POST['category_id'],
            'content' => $_POST['content'],
            'priority_id' => $_POST['priority_id'],
        ];
        echo $tasks->insert($data);
    });

    route('/tasks/update', function(){
        $tasks = new TasksService();
        $task_id = $_POST['task_id'];
        $data = [
            'user_id' => $_POST['user_id'],
            'content' => $_POST['content'],
            'priority_id' => $_POST['priority_id'],
        ];
        
        echo $tasks->update($task_id, $data);
    });


    route('/tasks/delete', function(){
        $tasks = new TasksService();
        $task_id = $_POST['task_id'];
        echo $tasks->delete($task_id);
    });    

    route('/task', function(){
        $tasks = new TasksService();
        $task_id = $_GET['task_id'];
        echo $tasks->task($task_id);
    });    

    route('/tasks/change-task-done', function(){
        $tasks = new TasksService();
        $task_id = $_POST['task_id'];
        $has_done = $_POST['has_done'];
        echo $tasks->changeTaskDone($task_id, $has_done);
    });


    route('/categories', function(){
        $category = new CategoriesService();
        $category->all();
    });

    route('/priorities', function(){
        $priorities = new PrioritiesService();
        echo $priorities->all();
    });


    // dispatch the route action
    $action = $_SERVER['REQUEST_URI'];  
    // TODO HERE :
    // ["REQUEST_METHOD"]
    dispatch($action);
?>