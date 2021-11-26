<?php

$routes = [];

function route($action, $callback){
    global $routes;
    $action = trim($action, "/");
    $action = explode("?", $action)[0];
    $routes[ $action ] = $callback; 
}

function dispatch($action){
    global $routes;
    $action = trim($action, "/");
    $action = explode("?", $action)[0];
    $callback = $routes[ $action ];
    echo call_user_func($callback);
}


?>