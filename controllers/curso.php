<?php
$db = new Database();
$id = $_GET["id"];
$course = $db->query("SELECT * FROM tblCurso where CURSOID = ?", [$id])->getOrFail();

if (!$course) {
    $abort();
}
// if ($course['idUsuario' !== $idUsuarioActual]) {
//     abort(Response::FORBIDDEN);
// }

$instructorQuery = $db->query("SELECT tblUsuario.USER_Nombre, tblUsuario.USER_Apellido  
  FROM tblUsuario 
  INNER JOIN tblInstructor ON tblUsuario.USERID = tblInstructor.USERID 
  INNER JOIN tblCursoInstructor ON tblCursoInstructor.INSTRUCTORID = tblInstructor.INSTRUCTORID
  INNER JOIN tblCurso ON tblCurso.CURSOID = tblCursoInstructor.CURSOID
  WHERE tblCurso.CURSOID = ?", [$id])->get();

if ($instructorQuery) {
    $nombreInstructor = htmlspecialchars($instructorQuery['USER_Nombre'], ENT_QUOTES, "UTF-8");
    $apellidoInstructor = htmlspecialchars($instructorQuery['USER_Apellido'], ENT_QUOTES, "UTF-8");
} else {
    $nombreInstructor = "Instructor no encontrado";
}

$id = $course["CURSOID"];
$nombreCurso = htmlspecialchars($course["CURSO_Nombre"], ENT_QUOTES, "UTF-8");
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



$title = $nombreCurso;

require  "views/curso.view.php";
