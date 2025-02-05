<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Session;

$usuarioId = Session::getUser("id");
$cursoId = $_GET["CURSOID"];
$curso = App::resolve(CursoRepository::class)->getEvaluacion($cursoId,$usuarioId);

if($curso){
    $instructorName = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
    $cursoNombre = $curso["CURSO_Nombre"];
    if($curso["CURSO_Modalidad"] === "virtual"){
        return view("/docenteOrInstructor/encuestas/evaluarCurso-F10PSA19.00.view.php", [
            "title" => "Evaluar Curso",
            "cursoNombre" => $cursoNombre,
            "instructorNombre" => $instructorName["nombre"],
            "questions" => App::resolve(PreguntaRepository::class)->getPreguntas(2),
            "cursoId" => $cursoId
        ]);
    }
    else{
        return view("/docenteOrInstructor/encuestas/evaluarCurso-F04PSA19.02.view.php", [
            "title" => "Evaluar Curso",
            "cursoNombre" => $cursoNombre,
            "instructorNombre" => $instructorName["nombre"],
            "questions" => App::resolve(PreguntaRepository::class)->getPreguntas(1),
            "preguntaInstructor" => "La o el instructor inició en los primeros 10 minutos",
            "preguntaOrganizacion" => "La organización del evento fue",
            "cursoId" => $cursoId
        ]);
    }
}

