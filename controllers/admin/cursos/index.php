<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

$title = "Cursos";

require view("admin/cursos/index.view.php");
