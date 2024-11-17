<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$db->query("SELECT * FROM tblArea WHERE AREAID = ?", [$_POST["id"]]);

$errors = [];

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$siglas = strtoupper($_POST["siglas"]);

if (!Validator::string($nombre, 1, 100)) {
    $errors['nombre'] = "Favor de introducir un nombre de área válido.";
}

if (!Validator::string($siglas, 1, 8)) {
    $errors['siglas'] = "Favor de introducir unas siglas de área válidas.";
}

if (count($errors)) {
    return require view("admin/areas/edit.view.php");
}

$db->query(
    "UPDATE tblArea SET AREA_Nombre = ?, AREA_Siglas = ? WHERE AREAID = ?",
    [$nombre, $siglas, $id]
);

header("location: /admin/areas");
die();
