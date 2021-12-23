<?php

use Framework\Route;

Route::get('/user/list', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::get('/user/detail/{id}', 'UserController@detail');

$router = new Route();
$route = $router->matchController();