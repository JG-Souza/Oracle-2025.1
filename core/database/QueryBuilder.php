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

    public function verificaLogin($email, $senha)
    {
        $sql = sprintf('SELECT * FROM users WHERE email = :email AND password = :password' );


        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'password' => $senha
            ]);

            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user ? $user : false;

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
        $sql = 'SELECT posts.*, users.name AS author_name
                FROM posts
                JOIN users ON posts.user_id = users.user_id
                ORDER BY posts.created_at DESC
                LIMIT :limit';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectAllPost($table, $inicio = null, $rows_count = null):mixed
    {
        $sql = "select * from {$table}";

        if($inicio >= 0 && $rows_count > 0){
            $sql .= " LIMIT {$inicio}, {$rows_count}";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectAllUsers($table, $inicio = NULL, $rowsCount = NULL)
    {
        $sql = "select * from {$table}";

        if ($inicio!==null && $rowsCount!==null) {
            $sql .= " LIMIT :inicio, :rowsCount";
        }

        try {
            $stmt = $this->pdo->prepare($sql);

            if ($inicio !== null && $rowsCount !== null) {
                $stmt->bindValue(':inicio', (int) $inicio, PDO::PARAM_INT);
                $stmt->bindValue(':rowsCount', (int) $rowsCount, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) FROM {$table}";

        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return intval(value: $stmt->fetch(PDO::FETCH_NUM)[0]);
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function selectOne($table, $post_id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE post_id=:id LIMIT 1', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $post_id]);

            return $stmt->fetch(PDO::FETCH_OBJ);;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //INSERT INTO `posts`(`post_id`, `title`, `origin`, `story`, `curiosity`, `lesson`, `refference`, `is_in_carousel`, `img_path`, `user_id`, `created_at`, `updated_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]')
    public function insert($table, $parameters){
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
        $table,
        implode(', ', array_keys($parameters)),
        ':' . implode(', :', array_keys($parameters)),
    );
    
    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        return $stmt->fetchAll(PDO::FETCH_CLASS);

    } catch (Exception $e) {
        die($e->getMessage());
    }
    }

    public function updatePost($table, $post_id, $parameters){

        $sql = sprintf('UPDATE %s SET %s WHERE post_id = :post_id',
        $table,
        implode(', ', array_map(function($param){
            return $param . ' = :' . $param;
        }, array_keys($parameters))),
        $post_id
    );
    
    $parameters['post_id'] = $post_id;

    try{
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        return $stmt->fetchAll(PDO::FETCH_CLASS);

    } catch (Exception $e) {
        die($e->getMessage());
    }
    }

    // funcao de editar
    // UPDATE users SET id='[value-1]',name='[value-2]',email='[value-3]',password='[value-4]',role='[value-5]',img_path='[value-6]' WHERE 1
    public function updateUser($table, $id, $parameters) {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE user_id = :user_id',
            $table,
            implode(', ', array_map(function($param) {
                return $param . ' = :' . $param;
            }, array_keys($parameters)))
        );

        $parameters['user_id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function deletePost($table, $post_id) {
    $sql = sprintf('DELETE FROM %s WHERE post_id = :post_id', $table);

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['post_id' => $post_id]);
    } catch (Exception $e) {
        die($e->getMessage());
    }
    }

    // DELETE FROM users WHERE 0
    public function deleteUser($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE user_id = :user_id', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $id]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}