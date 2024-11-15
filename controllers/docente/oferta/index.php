<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$title = "Oferta";

$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

require  view("/docente/oferta/index.view.php");
