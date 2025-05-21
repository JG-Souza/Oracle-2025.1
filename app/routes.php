<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('crud-usuarios', 'UsuariosController@index');
$router->post('crud-usuarios/create', 'UsuariosController@store');