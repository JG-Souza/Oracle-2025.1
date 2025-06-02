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

    public function selectAll($table, $inicio = null, $rows_count = null):mixed
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

    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) FROM ($table)";

        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return intval(value: $stmt->fetch(PDO::FETCH_NUM)[0]);
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function selectOne($table, $id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            return $stmt->fetchAll(PDO::FETCH_CLASS);

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

    public function update($table, $post_id, $parameters){
        $sql = sprintf('UPDATE %s SET %s WHERE post_id = :id',
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

    public function delete($table, $post_id) {
    $sql = sprintf('DELETE FROM %s WHERE post_id = :id', $table);

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $post_id]);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

}