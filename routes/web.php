<?php

use Framework\Middlewares\LogMiddleware;
use Framework\Route;

//Home
Route::get('/', 'HomeController@index');

//Task
Route::get('/task', 'TaskController@index');
Route::post('/task/add-task', 'TaskController@create');
Route::post('/task/update-status/{id}', 'TaskController@updateStatus');
Route::get('/task/edit/{id}', 'TaskController@edit');

//User
Route::get('/user/list', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::get('/user/edit/{id}', 'UserController@edit', [LogMiddleware::class]);
Route::get('/user/detail/{id}', 'UserController@detail');

$router = new Route();

try {
    $route = $router->getRoute();
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit();
}


$route = $router->matchController();