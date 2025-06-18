<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class IndividualController
{

    public function index($id)
    {
        $post = App::get('database') -> selectOne('posts', $id);

        return view('site/post-individual', compact('post'));
    }
}