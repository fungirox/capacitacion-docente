<?php

use Core\App;
use Core\Database;
use Core\Repositories\CursoRepository;
use Core\Repositories\PreguntaRepository;
use Core\Roles\Roles;
use Core\Session;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");
$cursoId = $_GET["CURSOID"];
$curso = $CursoRepository->getEvaluacion($cursoId,$userId);
$instructorName = $UsuarioRepository->getInstructorFullName($cursoId);
$courseName = $curso["CURSO_Nombre"];
//$rutaDestino = $curso["CURSO_Modalidad"] === "virtual" ? "" : "";
//$questions = $PreguntaRepository->getPreguntas(1);
if($curso){
    if($curso["CURSO_Modalidad"] === "virtual"){
        // Esta es la pregunta clave que inicia la evaluación del instructor
        $preguntaInstructor = "La o el instructor inició en los primeros 10 minutos";
        // Esta es la pregunta clave que inicia la evaluación de la organización
        $preguntaOrganizacion = "La organización del evento fue";
        $rutaDestino = "";
        $questions = $PreguntaRepository->getPreguntas(1);
    }
    else{
        $rutaDestino = "";
        $questions = $PreguntaRepository->getPreguntas(2);
    }
}









return view("/docenteOrInstructor/encuestas/evaluarCurso-F04PSA19.view.php", [
    "title" => "Evaluar Curso",
    "courseName" => $courseName,
    "instructorNombre" => $instructorName["nombre"],
    "questions" => $questions,
    "preguntaInstructor" => $preguntaInstructor,
    "preguntaOrganizacion" => $preguntaOrganizacion
]);
