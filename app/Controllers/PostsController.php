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
            'title'=> $_POST['titulo'],
            'origin' => $_POST['origem'],
            'story' => $_POST['historia'],
            'curiosity' => $_POST['curiosidades'],
            'lesson' => $_POST['licoes'],
            'reference' => $_POST['referencias'],
            'user_id' => 123,
        ];

        App::get('database')->insert('posts',$parameters);

        header('Location: /tabela-de-posts');
    }


    public function update()
    {
        $parameters = [
            'title'         => $_POST['titulo'],
            'origin'        => $_POST['origem'],
            'story'         => $_POST['historia'],
            'curiosity'     => $_POST['curiosidades'],
            'lesson'        => $_POST['licoes'],
            'reference'     => $_POST['referencias'],
            'user_id'       => $_POST['user_id'], 
        ];

        $post_id = $_POST['id'];
        
        App::get('database')->update('posts', $post_id, $parameters);

        header('Location: /tabela-de-posts');
        exit;
    }

    public function delete()
    {
        $post_id = $_POST['id'];

        App::get('database')->delete('posts', $post_id);

        header('Location: /tabela-de-posts');

    }
}