<?php

use Core\Database;

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // AUTORIZAR QUE SEA UN ADMINISTRADOR.
    $db->query("DELETE FROM tblCarrera WHERE CARRERAID = ?", [$_POST["id"]]);
}

$allCareers = $db->query("SELECT * FROM tblCarrera")->getAll();

$title = "Carreras";

require  view("admin/carreras/carreras.view.php");
