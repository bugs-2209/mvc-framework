<?php

use Framework\Route;

//Home
Route::get('/', 'HomeController@index');

//Task
Route::get('/task', 'TaskController@index');
Route::post('/task/add-task', 'TaskController@create');
Route::post('/task/update-status/{id}', 'TaskController@updateStatus');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/update/{id}', 'TaskController@update');

//User
Route::get('/users', 'UserController@index');
Route::post('/user/create', 'UserController@create');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::post('/user/delete/{id}', 'UserController@delete');

$router = new Route();

try {
    $route = $router->getRoute();
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit();
}


$route = $router->matchController();