<?php
$db = new Database();
$id = $_GET["id"];
$course = $db->query("SELECT * FROM tblCurso where CURSOID = ?", [$id])->fetch();

if (!$course) {
    $abort();
}

// if ($course['idUsuario' !== $idUsuarioActual]) {
//     abort(Response::FORBIDDEN);
// }

$id = $course["CURSOID"];
$nombre = htmlspecialchars($course["CURSO_Nombre"], ENT_QUOTES, "UTF-8");

$title = $nombre;

require  "views/curso.view.php";
