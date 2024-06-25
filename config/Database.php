<?php
class Database {
    public $connection;

    public function __construct() {
        require "env.php";

        $dsn = "sqlsrv:Server=$server;Database=$database";

        $this->connection = new PDO($dsn, $userName, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}
