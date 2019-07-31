<?php

declare(strict_types = 1);

namespace AnyTests;

use PDO;
use PDOException;

class Database
{
    private $connection;

    protected $table;

    private $host = 'localhost';
    private $port = 3306;
    private $dbName = 'any_tests';
    private $user = 'lukasuser';
    private $password = 'test_user';

    /**
     * Database constructor.
     * @param $connection
     */
    public function __construct()
    {
        $this->connection = $this->makeConnection();
    }

    public function getConnection() : PDO
    {
        return $this->connection;
    }

    private function makeConnection() : PDO
    {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbName;charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            return new PDO(
                $dsn,
                $this->user,
                $this->password,
                $options
            );
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
    }
}