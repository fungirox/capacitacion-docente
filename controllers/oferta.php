<?php
$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->fetchAll();

$coursesCount = count($allCourses);
$noCoursesFound = ($coursesCount === 0);

$title = "Oferta";

require  "views/oferta.view.php";
