<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {   
        $page = 1;
        
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = intval(value:$_GET['page']);
            if($page <= 0) {
                return redirect('/crud-usuarios');
            }
        }

        $itensPage = 5;

        $inicio = $itensPage*$page - $itensPage;

        $rowsCount = App::get('database')->countAll('users');

        if($inicio > $rowsCount){
            return redirect('/crud-usuarios');
        }

        $usuarios = App::get('database')->selectAllUsers('users', $inicio, $itensPage);

        $total_pages = ceil($rowsCount / $itensPage);

        if($page > $total_pages){
            header('Location: /users?paginacaonumero=');
            exit;
        }


        return view('admin/crud-usuarios', compact('usuarios', 'total_pages', 'page'));
    }

    public function store()
    {

        session_start();

        $usuarioAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

        $temporario = $_FILES['foto']['tmp_name'];

        $nomeImagem = sha1(uniqid($_FILES['foto']['name'], true)) . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        $caminhodaImagem = "public/assets/fotos-perfil/" . $nomeImagem;

        move_uploaded_file($temporario, $caminhodaImagem);

         $role = ($usuarioAdmin && isset($_POST['is_admin'])) ? 'admin' : 'user';



        $parameters = [
            'name' => $_POST['nome'],
            'email' => $_POST['email'],
            'password' => $_POST['senha'],
            'img_path' => $caminhodaImagem,
            'role' => $role
        ];

        if (empty($temporario)) {
            $parameters['img_path'] = 'public/assets/avatar-generico.avif';
        }

        App::get('database')->insert('users', $parameters);

        header('Location: /crud-usuarios');
    }

    public function edit()
    {


        session_start();

        $usuarioAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

        $fotoAntiga = $_POST['imagem-antiga'];


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

        $id = $_POST['user_id'];
        
        
        if (empty($temporario)) {
            $parameters['img_path'] = $fotoAntiga;
        }

        if ($usuarioAdmin) {
        $parameters['role'] = isset($_POST['is_admin']) ? 'admin' : 'user';
     }   

        App::get('database')->updateUser('users', $id, $parameters);

        header('Location: /crud-usuarios');
    }

    public function delete ()
    {
        $id = $_POST['user_id'];

        App::get('database')->deleteUser('users', $id);

        header('Location: /crud-usuarios');
    }
}