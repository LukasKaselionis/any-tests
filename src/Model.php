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

    public function insert(array $data): void
    {
        // INSERT INTO table (field, field, ...) VALUES (value, value, ...)
        $fieldsArray = array_keys($data);
        $fieldsString = implode(', ', $fieldsArray);
        $paramsArray = [];

        foreach ($fieldsArray as $item) {
            $paramsArray[] = ':' . $item;
        }

        $paramsString = implode(', ', $paramsArray);

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, $fieldsString, $paramsString);

        $stmt = $this->getConnection()->prepare($sql);

        foreach ($fieldsArray as $item) {
            $stmt->bindValue(':'.$item, $data[$item], $this->getPDOType($data[$item]));
        }

        $stmt->execute();
    }

    private function getPDOType ($value): int {
        if (is_string($value)){
            return PDO::PARAM_STR;
        }

        if (is_int($value)){
            return PDO::PARAM_INT;
        }

        return PDO::PARAM_NULL;
    }
}
