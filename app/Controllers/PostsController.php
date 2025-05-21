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
}