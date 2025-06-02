<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{
    public function index(): mixed
    {
        $page = 1;

        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
            $page = intval(value: $_GET['paginacaoNumero']);

            if($page <= 0){
                return redirect(path:'admin/tabela-de-posts');
            }
        }
        
        $itensPage = 5;

        $inicio = $itensPage * $page - $itensPage;

        $rows_count = App ::get(key:'database') -> countAll('posts');

        if($inicio > $rows_count){
            return redirect(path: 'admin/tabela-de-posts');
        }

        $posts = App::get('database') -> selectAll('posts');

        if($rows_count < 1){
            $rows_count = 1;
        }
        
        $total_pages = ceil(num: $rows_count/$itensPage);
        
        if($page > $total_pages){
            header(header:'Location: /posts?paginacaoNumero=1');
            exit;
        }

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

        $id = $_POST['post_id'];

        $post = App::get('database') -> selectOne('posts', $id);

        $caminhoImagem = $post->img_path;

        if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){

            $temporario = $_FILES['imagem']['tmp_name'];

            $nomeImagem = sha1(uniqid($_FILES['imagem']['name'], true)) . "." . pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

            $caminhoImagem = "public/assets/imgPosts/" . $nomeImagem;

            move_uploaded_file($temporario, $caminhoImagem);

            if($post && !empty($post->img_path) && file_exists($post->img_path)){
                unlink($post->img_path);
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
            'user_id'       => 123, 
        ];

        $post_id = $_POST['post_id'];
        
        App::get('database')->update('posts', $post_id, $parameters);

        header('Location: /tabela-de-posts');
        exit;
    }

    public function delete()
    {
        $post_id = $_POST['post_id'];

        $post = App::get('database')->selectOne('posts', $post_id);

        $caminhoImagem = $post->img_path;

        if(file_exists($caminhoImagem)){
            unlink($caminhoImagem);
        }


        App::get('database')->selectOne('posts', $post_id);

        header('Location: /tabela-de-posts');

    }
}