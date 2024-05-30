<?php
require_once "env.php";

try {
    $connection = new PDO("sqlsrv:Server=$server;Database=$database", $userName, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die(print_r($exception->getMessage()));
}
