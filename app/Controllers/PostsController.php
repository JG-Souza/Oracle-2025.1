<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{

    public function index()
    {
        $posts = App::get('database') -> selectAll('posts');

        return view('admin/tabela-de-posts', compact('posts'));
    }

    public function store(){

        $temporario = $_FILES['imagem']['tmp_name'];

        $nomeImagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

        $caminhoImagem = "public/assets/imgPosts/" . $nomeImagem;

        move_uploaded_file($temporario, $caminhoImagem);


        $parameters = [
            'title'=> $_POST['titulo'],
            'origin' => $_POST['origem'],
            'story' => $_POST['historia'],
            'curiosity' => $_POST['curiosidades'],
            'lesson' => $_POST['licoes'],
            'refference' => $_POST['referencias'],
            'img_path' => $caminhoImagem,
            'user_id' => 1,
        ];

        App::get('database')->insert('posts',$parameters);

        header('Location: /tabela-de-posts');
    }


    public function update()
    {

        $id = $_FILES['post_id'];

        $posts = App::get('database') -> selectOne('posts');

        $caminhoImagem = post->img_path;

        if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){

            $temporario = $_FILES['imagem']['tmp_name'];

            $nomeImagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

            $caminhoImagem = "public/assets/imgPosts/" . $nomeImagem;

            move_uploaded_file($temporario, $caminhoImagem);

            if($post && !empty($post->img_path) && file_exists($post->img_path)){
                unlink($pots->img_path);
            }
        }


        $parameters = [
            'title'         => $_POST['titulo'],
            'origin'        => $_POST['origem'],
            'story'         => $_POST['historia'],
            'curiosity'     => $_POST['curiosidades'],
            'lesson'        => $_POST['licoes'],
            'refference'     => $_POST['referencias'],
            'img_path'      => $caminhoImagem,
            'user_id'       => 1, 
        ];

        $post_id = $_POST['post_id'];
        
        App::get('database')->update('posts', $post_id, $parameters);

        header('Location: /tabela-de-posts');
        exit;
    }

    public function delete()
    {
        $post_id = $_POST['post_id'];

        App::get('database')->delete('posts', $post_id);

        header('Location: /tabela-de-posts');

    }
}