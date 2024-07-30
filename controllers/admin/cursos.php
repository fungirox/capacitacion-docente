<?php

$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

$title = "Cursos";

require  "views/admin/cursos.view.php";
