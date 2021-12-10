<?php
    require 'bootstrap.php';
    require_once "vendor/autoload.php";

    require_once "route.php";
    header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Origin: http://localhost:8080/');

    use App\services\PrioritiesService;
    use App\services\CategoriesService;
    use App\classes\Task;
    use App\classes\UserAuth;
    
    use GuzzleHttp\Client;


    /* Register all Routes */
    route('/authentication/login', function(){
        $userAuth = new UserAuth();
        echo $userAuth->login($_POST);
    });

    route('/tttt', function(){
        $client = new Client([
            'base_uri' => '192.168.1.100:5001',
            'timeout'  => 3.0,
        ]);
        $data = [
            'user_id' => 3,
            'category_id' => 1,
            'content' => "test",
            'priority_id' => 1,
        ];
        $response = $client->request('POST', '/tasks/add', ['form_params' => $data]);
        $status = json_decode((string)$response->getBody());
        var_dump($status->status);
    });

  

    route('/authentication/register', function(){
        $userAuth = new UserAuth();
        echo $userAuth->singUp($_POST);
    });

    route('/tasks', function(){
        $tasks = new Task();
        echo $tasks->get($_GET);
    });

    route('/tasks/add', function(){
        $tasks = new Task();
        echo $tasks->insert($_POST);
    });

    route('/tasks/update', function(){
        $tasks = new Task();
        echo $tasks->update($_POST);
    });


    route('/tasks/delete', function(){
        $tasks = new Task();
        echo $tasks->delete($_POST);
    });    

    route('/task', function(){
        $tasks = new Task();
        echo $tasks->task($_GET);
    });    

    route('/tasks/change-task-done', function(){
        $tasks = new Task();
        echo $tasks->changeTaskDone($_POST);
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