<?php

declare(strict_types = 1);

namespace AnyTests;

use PDO;

class Model extends Database
{
    protected $table;

    public function get(): array {
        $sql = 'SELECT * FROM '.$this->table;
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function find(int $id): ?array {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();
        if ($data == false) {
            return null;
        }
        return $data;
    }
}