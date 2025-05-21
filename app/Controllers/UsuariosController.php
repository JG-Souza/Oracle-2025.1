<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {
        $usuarios = App::get('database')->selectAll('users');

        return view('admin/crud-usuarios', compact('usuarios'));
    }

    public function store()
    {
        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'role' => $_POST['role'],
            'foto' => $_POST['foto'],
        ];
        App::get('database')->insert('users', $parameters);
        header('Location: /crud-usuarios');
        
    }

}