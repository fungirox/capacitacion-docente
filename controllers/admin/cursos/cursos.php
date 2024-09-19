<?php

use Core\Database;

$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();
$title = "Cursos";

require view("admin/cursos/cursos.view.php");
