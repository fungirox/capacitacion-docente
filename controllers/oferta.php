<?php
$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->fetchAll();

$title = "Oferta";

require  "views/oferta.view.php";
