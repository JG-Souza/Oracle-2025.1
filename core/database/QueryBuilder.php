<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $sql = "select * from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //função para pegar dados dos posts que vão ficar em destaque, no banco de dados.
    public function getDestaques(int $limit = 5)
    {
        $sql = 'SELECT * FROM posts
                WHERE is_in_carousel = 1
                ORDER BY created_at DESC
                LIMIT :limit';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //função para pegar dados dos posts que vão aparecer em últimos posts, no banco de dados.
    public function getUltimosPosts(int $limit = 5)
    {
        $sql = 'SELECT * FROM posts
                ORDER BY created_at DESC
                LIMIT :limit';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}