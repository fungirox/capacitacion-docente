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
$descripcion = htmlspecialchars($course["CURSO_Descripcion"], ENT_QUOTES, "UTF-8");
$tipo = htmlspecialchars($course["CURSO_Tipo"], ENT_QUOTES, "UTF-8");
$totalHoras = htmlspecialchars($course["CURSO_Total_Horas"], ENT_QUOTES, "UTF-8");
$fechaInicio = htmlspecialchars($course["CURSO_Fecha_Inicio"], ENT_QUOTES, "UTF-8");
$fechaFinal = htmlspecialchars($course["CURSO_Fecha_Final"], ENT_QUOTES, "UTF-8");
$externo = htmlspecialchars($course["CURSO_Externo"], ENT_QUOTES, "UTF-8");
$tipoCurso = ($externo === "true") ? "Externo" : "Interno";
$modalidad = htmlspecialchars($course["CURSO_Modalidad"], ENT_QUOTES, "UTF-8");
$activo = htmlspecialchars($course["CURSO_Activo"], ENT_QUOTES, "UTF-8");
$enProgreso = htmlspecialchars($course["CURSO_En_Progreso"], ENT_QUOTES, "UTF-8");
$perfil = htmlspecialchars($course["CURSO_Perfil"], ENT_QUOTES, "UTF-8");


$title = $nombre;

require  "views/curso.view.php";
