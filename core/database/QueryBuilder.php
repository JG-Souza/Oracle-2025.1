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

    public function selectAll($table, $inicio = NULL, $rowsCount = NULL)
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

    // funcao de contar
    // SELECT COUNT(*) as total FROM users
    public function count($table)
    {
        $sql = "SELECT COUNT(*) as total FROM {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return intval($stmt->fetch(PDO::FETCH_NUM)[0]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //funcao de criar
    // INSERT INTO users(id, name, email, password, role, img_path) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
    public function insert($table, $parameters) {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
            $table,
            implode(', ', array_keys($parameters)),
            implode(', :', array_keys($parameters)),
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    // funcao de editar
    // UPDATE users SET id='[value-1]',name='[value-2]',email='[value-3]',password='[value-4]',role='[value-5]',img_path='[value-6]' WHERE 1
    public function update($table, $id, $parameters) {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $table,
            implode(', ', array_map(function($param) {
                return $param . ' = :' . $param;
            }, array_keys($parameters)))
        );

        $parameters['id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // DELETE FROM users WHERE 0
    public function delete($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s',
        $table, 
        'id = :id'
    );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}