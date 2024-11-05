<?php

namespace Core;
use PDO;

class Database {
    public $connection;
    public $statement;

    public function __construct() {
        require "env.php";

        $dsn = "sqlsrv:Server=$server;Database=$database";

        $this->connection = new PDO($dsn, $userName, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function getAll() {
        return $this->statement->fetchAll();
    }

    public function get() {
        return $this->statement->fetch();
    }

    public function getOrFail() {
        $result = $this->get();

        if(!$result) {
            abort();
        }

        return $result;
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}
