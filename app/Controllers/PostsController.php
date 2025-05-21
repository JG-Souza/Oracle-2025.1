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
}