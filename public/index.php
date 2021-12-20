<?php
// require autolaod
require_once __DIR__ . '/../vendor/autoload.php';

use Framework\Controllers\UserController;
use Framework\Router;

Router::get('/user/{name}/2', 'UserController@detail');
Router::get('/user/detail/2', 'UserController@detailBy');
Router::get('/user/{name}/{id}', 'UserController@detailById');

$router = new Router();
$route = $router->getRoute();

