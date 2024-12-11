<?php

use Http\Forms\ServicioForm;

ServicioForm::validate($attributes = [
    "tipo" => trim($_POST["tipo"]),
    "nombre" => trim($_POST["nombre"]),
    "descripcion" => trim($_POST["descripcion"]),
]);

redirect("/admin/cursos");

// use Core\App;
// use Core\Database;
// use Core\Validator;

// $db = App::resolve(Database::class);

// $errors = [];

// // Recibir los datos del formulario para nuevo curso
// $nombreCurso = $_POST["service-name"];
// $descripcionCurso = $_POST["service-description"];
// $tipoCurso = $_POST["service-type"];
// $categoriaCurso = $_POST["service-category"];
// $instructorId = $_POST["teachers"];
// $areas = $_POST["areas"] ?? [];
// $horasPresenciales = $_POST["physical-hours"];
// $horasVirtuales = $_POST["virtual-hours"];
// $fechaInicio = $_POST["start-date"];
// $fechaFin = $_POST["finish-date"];

// $modalidadCurso = $_POST["service-category"];
// $cursoEnProgreso = 1;
// $cursoActivo = 1;
// $cursoPerfil = 1;

// // Recibir los datos del formulario HorarioCurso
// $diasSemana = $_POST["weekdays"] ?? [];
// $horaInicio = $_POST["horaInicio"];
// $horaFinal = $_POST["horaFinal"];
// $aula = $_POST["classroom"];


// // Validación de los datos
// if (!Validator::string($nombreCurso, 1, 100)) {
//     $errors['service-name'] = "Favor de introducir un nombre de curso válido.";
// }

// if (!Validator::string($descripcionCurso, 1, 500)) {
//     $errors['service-description'] = "Favor de introducir una descripción válida para el curso.";
// }

// if (!Validator::inArray($tipoCurso, ['curso', 'taller', 'diplomado'])) {
//     $errors['service-type'] = "El tipo de curso seleccionado no es válido.";
// }

// if (!Validator::inArray($categoriaCurso, ['0', '1'])) {
//     $errors['service-category'] = "La categoría seleccionada no es válida.";
// }

// if (!Validator::numeric($horasPresenciales) || $horasPresenciales < 0) {
//     $errors['physical-hours'] = "Favor de introducir un número válido para las horas presenciales.";
// }

// if (!Validator::numeric($horasVirtuales) || $horasVirtuales < 0) {
//     $errors['virtual-hours'] = "Favor de introducir un número válido para las horas virtuales.";
// }

// if (!Validator::date($fechaInicio)) {
//     $errors['start-date'] = "La fecha de inicio no es válida.";
// }

// if (!Validator::date($fechaFin)) {
//     $errors['finish-date'] = "La fecha de finalización no es válida.";
// }

// if (!Validator::inArray($modalidadCurso, ['0', '1'])) {
//     $errors['service-category'] = "La modalidad de servicio seleccionada no es válida.";
// }

// if (!empty($errors)) {
//     return require view("admin/cursos/create.view.php");
// }


//   # Por ahora las horas solo las sumaré para probar los inserts pero falta añadirlas a horario (solo presenciales)
//   $totalHoras = $horasPresenciales + $horasVirtuales;
//   $modalidadCurso = "Virtual";
//   if ($horasPresenciales > 0) {
//       $modalidadCurso = ($horasVirtuales > 0) ? "Hibrido" : "Presencial";
//   }

// // Insertar el curso en la base de datos
// $db->query(
//     "INSERT INTO tblCurso (CURSO_Nombre, CURSO_Descripcion, CURSO_Tipo, CURSO_Externo, CURSO_Total_Horas, 
//     CURSO_Fecha_Inicio, CURSO_Fecha_Final, CURSO_Modalidad, CURSO_En_Progreso, CURSO_Activo, CURSO_Perfil)
//     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
//     [$nombreCurso, $descripcionCurso, $tipoCurso, $categoriaCurso, $totalHoras, 
//     $fechaInicio, $fechaFin, $modalidadCurso, $cursoEnProgreso, $cursoActivo, $cursoPerfil]
// );

// $cursoId = $db->lastInsertId(); // Obtenemos el ID del curso recién insertado para las relaciones

// // Insertar instructor
// $db->query("INSERT INTO tblCursoInstructor (CURSOID, INSTRUCTORID) VALUES (?, ?)", [$cursoId, $instructorId]);

// // Insertar las áreas seleccionadas
// foreach ($areas as $areaId) {
//     $db->query("INSERT INTO tblCursoArea (CURSOID, AREAID) VALUES (?, ?)", [$cursoId, $areaId]);
// }

// // Insertar los días de la semana seleccionados
// foreach ($diasSemana as $dia) {
//     $db->query("INSERT INTO tblHorarioCurso (CURSOID, HORARIOCURSO_Dia_Semana, HORARIOCURSO_Hora_Inicio, HORARIOCURSO_Horas, HORARIOCURSO_Aula) 
//     VALUES (?, ?, ?, ?, ?)", [$cursoId, $dia, $horaInicio, 0, $aula]);
// }

// header("location: /admin/cursos");
// die();
