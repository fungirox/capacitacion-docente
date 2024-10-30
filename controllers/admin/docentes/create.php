<?php

use Core\Database;

$db = new Database();

$title = "Nuevo Docente";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
}

require view("admin/docentes/docentes-nuevo.view.php");
