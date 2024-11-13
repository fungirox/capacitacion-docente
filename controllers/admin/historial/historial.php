<?php
$title = "Historial";

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$activeCouses = $db-> query("SELECT * FROM tblCurso WHERE CURSO_Activo = 1 AND CURSO_En_Progreso = 0")->getAll();

require view("admin/historial/historial.view.php");
