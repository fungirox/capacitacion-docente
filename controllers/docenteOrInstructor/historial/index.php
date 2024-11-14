<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;

$db = App::resolve(Database::class);

// $allAreas = $db->query("SELECT * FROM tblArea")->getAll();

$title = "Historial de Cursos";

$isDocenteAndInstructor = $_SESSION["user"]["rol"] === Roles::DOCENTE_AND_INSTRUCTOR;

require view("/docenteOrInstructor/historial/index.view.php");
