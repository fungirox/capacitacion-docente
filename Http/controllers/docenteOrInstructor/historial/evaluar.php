<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = $_SESSION["user"]["rol"] === Roles::DOCENTE_AND_INSTRUCTOR;

$title = "Evaluar curso";

$instructorName = $db->query("SELECT u.USER_Nombre, u.USER_Apellido 
     FROM tblCurso c
     JOIN tblCursoInstructor ci ON c.CURSOID = ci.CURSOID
     JOIN tblInstructor i ON ci.INSTRUCTORID = i.INSTRUCTORID
     JOIN tblUsuario u ON i.USERID = u.USERID
     WHERE c.CURSOID = ?",[$_POST["CURSOID"]])->get();

$courseName = $db->query("SELECT c.CURSO_Nombre
    FROM tblCurso c
    WHERE c.CURSOID = ?",[$_POST["CURSOID"]])->get();

// Esta es la pregunta clave que inicia la evaluación del instructor
$preguntaInstructor = "La o el instructor inició en los primeros 10 minutos";

// Esta es la pregunta clave que inicia la evaluación de la organización
$preguntaOrganizacion = "La organización del evento fue";

// # Aquí necesitamos el id del curso que elegimos desde la interfaz de "historial" por ahora dejaré cursoid = 1
$questions = $db->query("SELECT *
FROM tblPregunta
WHERE ENCUESTAID = '1'")->getAll();

require view("/docenteOrInstructor/encuestas/evaluarCurso-F04PSA19.view.php");