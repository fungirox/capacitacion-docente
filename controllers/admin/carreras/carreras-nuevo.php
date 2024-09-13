<?php

require 'Validator.php';

$db = new Database();

$title = "Nueva Área";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    $nombre = trim($_POST["nombre"]);
    $siglas = trim(strtoupper($_POST["siglas"]));

    $validator = new Validator();

    if (!$validator->string($_POST["nombre"], 1, 100)) {
        $errors['nombre'] = "Favor de introducir el nombre de la carrera.";
    }

    if (!$validator->string($_POST["siglas"], 1, 8)) {
        $errors['siglas'] = "Favor de introducir las siglas de la carrera.";
    }

    if (empty($errors)) {
        $db->query(
            "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
            [$nombre, $siglas]
        );
    }
}

require "views/admin/carreras/carreras-nuevo.view.php";
