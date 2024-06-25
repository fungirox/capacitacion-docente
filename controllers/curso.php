<?php
$db = new Database();
$id = $_GET["id"];
$course = $db->query("SELECT * FROM tblCurso where CURSOID = ?", [$id])->fetch(PDO::FETCH_ASSOC);

$id = $course["CURSOID"];
$nombre = htmlspecialchars($course["CURSO_Nombre"], ENT_QUOTES, "UTF-8");

$title = $nombre;

require  "views/curso.view.php";
