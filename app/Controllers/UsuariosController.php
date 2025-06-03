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

        $temporario = $_FILES['foto']['tmp_name'];

        $nomeImagem = sha1(uniqid($_FILES['foto']['name'], true)) . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        $caminhodaImagem = "public/assets/fotos-perfil/" . $nomeImagem;

        move_uploaded_file($temporario, $caminhodaImagem);




        $parameters = [
            'name' => $_POST['nome'],
            'email' => $_POST['email'],
            'password' => $_POST['senha'],
            'img_path' => $caminhodaImagem,
        ];

        if (empty($temporario)) {
            $parameters['img_path'] = 'public/assets/avatar-generico.avif';
        }

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