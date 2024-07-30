<?php

$db = new Database();

$title = "Nueva Área";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db->query(
        "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
        [$_POST["nombre"], $_POST["siglas"]]
    );
}

require "views/admin/carreras/carreras-nuevo.view.php";
