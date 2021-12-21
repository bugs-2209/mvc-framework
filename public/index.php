<?php
// require autolaod
require_once __DIR__ . '/../vendor/autoload.php';

// use Framework\Controllers\UserController;
use Framework\Router;

Router::get('/{info}', 'UserController@info');
Router::get('/user/create', 'UserController@create');
Router::get('/user/{id}', 'UserController@userheheh');
Router::get('/user/detail/2', 'UserController@detailBy');
Router::get('/user/detail/{id}', 'UserController@detailId');
Router::get('/user/{name}/2', 'UserController@detail');
Router::get('/user/{name}/{id}', 'UserController@detailById');

$router = new Router();
$route = $router->getRoute();
$convertController = "Framework\\Controllers\\".$route['controller']."";
$controller = new $convertController;
$action = $route['action'];

call_user_func_array([$controller, $action], $route['param']);

