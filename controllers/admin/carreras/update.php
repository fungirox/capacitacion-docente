<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$db->query("SELECT * FROM tblCarrera WHERE CARRERAID = ?", [$_POST["id"]]);

# AUTORIZAR QUE SEA ADMIN

$errors = [];

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$siglas = strtoupper($_POST["siglas"]);

if (!Validator::string($nombre, 1, 100)) {
    $errors['nombre'] = "Favor de introducir un nombre de carrera válido.";
}

if (!Validator::string($siglas, 1, 8)) {
    $errors['siglas'] = "Favor de introducir unas siglas de carrera válidas.";
}

if (count($errors)) {
    return require view("admin/carreras/edit.view.php");
}

$db->query(
    "UPDATE tblCarrera SET CARRERA_Nombre = ?, CARRERA_Siglas = ? WHERE CARRERAID = ?",
    [$nombre, $siglas, $id]
);

header("location: /admin/carreras");
die();
