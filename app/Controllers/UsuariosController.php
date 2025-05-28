<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {

        $usuarios = App::get('database') -> selectAll('users'); 

        return view('admin/crud-usuarios', compact('usuarios'));
    }

    public function store()
    {
        $parameters = [
            'name' => $_POST['nome'],
            'email' => $_POST['email'],
            'password' => $_POST['senha'],
        ];

        App::get('database')->insert('users', $parameters);

        header('Location: /crud-usuarios');
    }

    public function edit()
    {
        $parameters = [
            'name' => $_POST['nome'],
            'email' => $_POST['email'],
            'password' => $_POST['senha'],
        ];

        $id = $_POST['id'];

        App::get('database')->update('users', $id, $parameters);

        header('Location: /crud-usuarios');
    }

    public function delete ()
    {
        $id = $_POST['id'];

        App::get('database')->delete('users', $id);

        header('Location: /crud-usuarios');
    }
}