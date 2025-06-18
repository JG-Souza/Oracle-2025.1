<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('lista-posts', 'ListaPostsController@index');
$router->get('landing-page', 'LandingPageController@exibirLandingPage');
$router->get('', 'ExampleController@index');
$router->get('login', 'LoginController@exibirLogin');
$router->get('dashboard', 'LoginController@exibirDashboard');

$router->post('login', 'LoginController@efetuaLogin');
$router->post('logout', 'LoginController@logout');    
$router->get('', 'ExampleController@index');

$router->get('crud-usuarios', 'UsuariosController@index');

// Métodos CRUD
$router->post('crud-usuarios/create', 'UsuariosController@store');
$router->post('crud-usuarios/edit', 'UsuariosController@edit');
$router->post('crud-usuarios/delete', 'UsuariosController@delete');
$router->get('tabela-de-posts', 'PostsController@index');
$router->post('tabela-de-posts/create', 'PostsController@store');
$router->post('tabela-de-posts/update', 'PostsController@update');
$router->post('tabela-de-posts/delete', 'PostsController@delete');

$router->get('post/{id}', 'IndividualController@index');

?>