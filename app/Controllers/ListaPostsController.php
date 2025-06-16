<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;
use PDO;

class ListaPostsController
{
    public function index()
{
    $config = [
        'connection' => 'mysql:host=localhost',
        'name'       => 'oracle_db',
        'username'   => 'root',
        'password'   => '',
        'options'    => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    ];

    $pdo = Connection::make($config);

    $query = $_GET['q'] ?? '';
    $page = isset($_GET['paginacaoNumero']) ? intval($_GET['paginacaoNumero']) : 1;
    if ($page < 1) $page = 1;

    $itensPage = 5;
    $inicio = ($page - 1) * $itensPage;

    if ($query) {
        $countSql = "SELECT COUNT(*) FROM posts WHERE title LIKE :q OR story LIKE :q";
        $stmtCount = $pdo->prepare($countSql);
        $stmtCount->execute(['q' => "%{$query}%"]);
        $rows_count = (int) $stmtCount->fetchColumn();

        $sql = "SELECT * FROM posts 
                WHERE title LIKE :q OR story LIKE :q 
                ORDER BY created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':q', "%{$query}%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', $itensPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $inicio, PDO::PARAM_INT);
        $stmt->execute();

        $posts = $stmt->fetchAll();

    } else {
        $stmtCount = $pdo->query("SELECT COUNT(*) FROM posts");
        $rows_count = (int) $stmtCount->fetchColumn();

        $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $itensPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $inicio, PDO::PARAM_INT);
        $stmt->execute();

        $posts = $stmt->fetchAll();
    }

    $total_pages = max(1, ceil($rows_count / $itensPage));

    if ($page > $total_pages) {
        header("Location: ?paginacaoNumero=1" . ($query ? "&q=" . urlencode($query) : ""));
        exit;
    }

    return view('site/lista-posts', compact('posts', 'total_pages', 'page', 'query'));
}

}

?>
