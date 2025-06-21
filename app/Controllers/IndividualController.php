<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class IndividualController
{

    public function index($id)
    {
        $post = App::get('database') -> selectOne('posts', $id);
        $user = App::get('database') -> selectOneUser('users', $post->user_id);

        return view('site/post-individual', compact('post', 'user'));
    }


}