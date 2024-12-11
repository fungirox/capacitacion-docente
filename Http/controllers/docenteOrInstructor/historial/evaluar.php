<?php

use Core\App;
use Core\Database;
use Core\Repositories\CursoRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Roles\Roles;
use Core\Session;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");
$cursoId = $_GET["CURSOID"];
$curso = App::resolve(CursoRepository::class)->getEvaluacion($cursoId,$userId);

if($curso){
    $instructorName = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
    $courseName = $curso["CURSO_Nombre"];
    if($curso["CURSO_Modalidad"] === "virtual"){
        return view("/docenteOrInstructor/encuestas/evaluarCurso-F10PSA19.00.view.php", [
            "title" => "Evaluar Curso",
            "courseName" => $courseName,
            "instructorNombre" => $instructorName["nombre"],
            "questions" => App::resolve(PreguntaRepository::class)->getPreguntas(2),
            "courseId" => $cursoId
        ]);
    }
    else{
        return view("/docenteOrInstructor/encuestas/evaluarCurso-F04PSA19.view.php", [
            "title" => "Evaluar Curso",
            "courseName" => $courseName,
            "instructorNombre" => $instructorName["nombre"],
            "questions" => App::resolve(PreguntaRepository::class)->getPreguntas(1),
            "preguntaInstructor" => "La o el instructor inició en los primeros 10 minutos",
            "preguntaOrganizacion" => "La organización del evento fue",
            "courseId" => $cursoId
        ]);
    }
}

