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
        $parameters = [
            'title '=> $_POST['titulo'],
            'origin' => $_POST['origem'],
            'story' => $_POST['historia'],
            'curiosity' => $_POST['curiosidades'],
            'lesson' => $_POST['licoes'],
            'reference' => $_POST['referencias'],
            'img_path' => $_POST['img_path'],
        ];

        App::get('database')->insert('posts',$parameters);

        header('Location: /tabela-de-posts');
    }

    
    public function edit($id)
    {
        $post = App::get('database')->selectById('posts', $id);
        return view('admin/editar-post', compact('post'));
    }

    public function update($id)
    {
        $parameters = [
            'title'         => $_POST['titulo'],
            'origin'        => $_POST['origem'],
            'story'         => $_POST['historia'],
            'curiosity'     => $_POST['curiosidades'],
            'lesson'        => $_POST['licoes'],
            'reference'     => $_POST['referencias'],
            'is_in_carousel'=> isset($_POST['is_in_carousel']) ? 1 : 0,
            'img_path'      => $_POST['img_path'],
            'user_id'       => $_POST['user_id'], // ou $_SESSION['user_id']
        ];

        App::get('database')->update('posts', $id, $parameters);

        header('Location: /tabela-de-posts');
        exit;
    }

    public function destroy($id)
    {
        App::get('database')->delete('posts', $id);

        header('Location: /tabela-de-posts');
        exit;
    }
}