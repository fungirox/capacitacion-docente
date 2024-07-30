<?php

$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

$title = "Oferta";

require  "views/oferta.view.php";
