<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{
    public function index(): mixed
    {
        session_start();

        $page = 1;

        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
            $page = intval($_GET['paginacaoNumero']);

            if($page <= 0){
                return redirect('admin/tabela-de-posts');
            }
        }

        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;

        $userId = $_SESSION['id'];
        $role = $_SESSION['role'];

        if($role === 'admin'){
            $rows_count = App::get('database')->countAll('posts');
            $posts = App::get('database')->selectAllPost('posts', $inicio, $itensPage);
        } else {
            $rows_count = App::get('database')->countPostsByUser($userId);
            $posts = App::get('database')->selectPostsByUser('posts', $userId, $inicio, $itensPage);
        }

        if($rows_count < 1){
            $rows_count = 1;
        }

        $total_pages = ceil($rows_count / $itensPage);

        if($inicio > $rows_count){
            return redirect('admin/tabela-de-posts');
        }

        if($page > $total_pages){
            header('Location: /tabela-de-posts?paginacaoNumero=1');
            exit;
        }

        return view('admin/tabela-de-posts', compact('posts', 'total_pages', 'page'));
    }

    public function store(){

        $temporario = $_FILES['imagem']['tmp_name'];

        $nomeImagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

        $caminhoImagem = "public/assets/imgPosts/" . $nomeImagem;

        move_uploaded_file($temporario, $caminhoImagem);

        $carrossel = isset($_POST['carrossel']);

        $parameters = [
            'title'=> $_POST['titulo'],
            'origin' => $_POST['origem'],
            'story' => $_POST['historia'],
            'curiosity' => $_POST['curiosidades'],
            'lesson' => $_POST['licoes'],
            'reference' => $_POST['referencias'],
            'img_path' => $caminhoImagem,
            'user_id' => $_POST['autor'],
            'is_in_carousel' => $carrossel,
        ];

        App::get('database')->insert('posts',$parameters);

        header('Location: /tabela-de-posts');
    }


    public function update()
    {

        $id = $_POST['post_id'];
        
        $post = App::get('database') -> selectOne('posts', $id);

        $caminhoImagem = $post->img_path;


        if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){

            $temporario = $_FILES['imagem']['tmp_name'];
            
            $nomeImagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

            $caminhoImagem = "public/assets/imgPosts/" . $nomeImagem;

            move_uploaded_file($temporario, $caminhoImagem);

            if(file_exists($post->img_path)){
                unlink($post->img_path);
            }
        }

        $carrossel = isset($_POST['carrossel']);

        $parameters = [
            'title'         => $_POST['titulo'],
            'origin'        => $_POST['origem'],
            'story'         => $_POST['historia'],
            'curiosity'     => $_POST['curiosidades'],
            'lesson'        => $_POST['licoes'],
            'reference'     => $_POST['referencias'],
            'img_path'      => $caminhoImagem,
            'is_in_carousel' => $carrossel,
        ];
        
        App::get('database')->updatePost('posts', $id, $parameters);

        header('Location: /tabela-de-posts');
        
    }

    public function delete()
    {
        $id = $_POST['post_id'];

        $post = App::get('database')->selectOne('posts', $id);

        $caminhoImagem = $post->img_path;

        if(file_exists($caminhoImagem)){
            unlink($caminhoImagem);
        }


        App::get('database')->deletePost('posts', $id);

        header('Location: /tabela-de-posts');

    }
}