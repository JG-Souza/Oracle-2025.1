<?php

namespace App\Controllers;

use App\Core\App;

class ListaPostsController
{
    public function index()
    {
        $page = 1;

        if (isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])) {
            $page = intval($_GET['paginacaoNumero']);
            if ($page <= 0) {
                return redirect(path: 'posts?paginacaoNumero=1');
            }
        }
        
        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;
        $rows_count = App::get('database')->countAll('posts');

        if ($rows_count < 1) {
            $rows_count = 1;
        }

        if ($inicio > $rows_count) {
            return redirect(path: 'posts?paginacaoNumero=1');
        }

        $posts = App::get('database')->selectAllListaPost('posts', $inicio, $itensPage, $page);
        $total_pages = ceil($rows_count / $itensPage);

        if ($page > $total_pages) {
            return redirect(path: 'posts?paginacaoNumero=1');
        }

        return view('site/lista-posts', compact('posts', 'total_pages', 'page'));
    }
}

?>
