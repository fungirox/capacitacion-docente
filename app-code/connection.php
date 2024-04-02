<?php
$server = "DESKTOP-KAQULH7\SQLEXPRESS";
$database = "test";
$userName = "sa";
$password = "sa";

try {
    $connection = new PDO("sqlsrv:Server=$server;Database=$database", $userName, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die(print_r($exception->getMessage()));
}
