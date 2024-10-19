<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$nombre = $_POST["nombre"];
$siglas = strtoupper($_POST["siglas"]);

if (!Validator::string($nombre, 1, 100)) {
    $errors['nombre'] = "Favor de introducir el nombre de la área.";
}

if (!Validator::string($siglas, 1, 8)) {
    $errors['siglas'] = "Favor de introducir las siglas de la área.";
}

if (!empty($errors)) {
    return require view("admin/areas/create.view.php");
}

# AUTORIZAR QUE SEA ADMIN

$db->query(
    "INSERT INTO tblArea (AREA_Nombre, AREA_Siglas) VALUES (?, ?)",
    [$nombre, $siglas]
);

header("location: /admin/areas");
die();
