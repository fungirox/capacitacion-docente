<?php

use Core\Database;
use Core\Validator;

$db = new Database();

$title = "Nueva Área";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    $nombre = $_POST["nombre"];
    $siglas = strtoupper($_POST["siglas"]);

    if (!Validator::string($nombre, 1, 100)) {
        $errors['nombre'] = "Favor de introducir el nombre de la carrera.";
    }

    if (!Validator::string($siglas, 1, 8)) {
        $errors['siglas'] = "Favor de introducir las siglas de la carrera.";
    }

    if (empty($errors)) {
        $db->query(
            "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
            [$nombre, $siglas]
        );
        header("location: /admin/carreras");
        exit();
    }
}

require view("admin/carreras/carreras-nuevo.view.php");
