<?php
$db = new Database();
$allCourses = $db->query("SELECT * FROM tblCurso")->fetchAll(PDO::FETCH_ASSOC);

require  "views/oferta.view.php";
