<?php
$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->fetchAll(PDO::FETCH_ASSOC);

$title = "Oferta";

require  "views/oferta.view.php";
