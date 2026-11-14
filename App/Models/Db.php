<?php

namespace App\Models;


class Db {

    private \PDO $db;

    public function __construct(string $user, string $password, string $dbName, string $host = '127.0.0.1', int|string $port = 3306)
    {
        $dsn = "mysql:dbname=$dbName;host=$host;port=$port";
        try {
            $this->db = new \PDO($dsn, $user, $password);
        } catch (\PDOException $e) {
            die('Ha fallat la connexió: ' . $e->getMessage() . '  '. $dsn);
        }
    }

    public function getDb(): \PDO {
        return $this->db;
    }
}