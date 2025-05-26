<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('tabela-de-posts', 'PostsController@index');
$router->post('tabela-de-posts/create', 'PostsController@store');
$router->post('tabela-de-posts/update', 'PostsController@update');
$router->post('tabela-de-posts/delete', 'PostsController@delete');