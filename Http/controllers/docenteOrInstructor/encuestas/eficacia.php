<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Session;

$userId = Session::getUser("id");
$cursoId = $_GET["CURSOID"];
$curso = App::resolve(CursoRepository::class)->getEficacia($cursoId,$userId);

if($curso){
    $instructorName = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
    $cursoNombre = $curso["CURSO_Nombre"];
    return view("/docenteOrInstructor/encuestas/evaluarCurso-F08PSA19.00.view.php", [
        "title" => "Evaluar Curso",
        "cursoNombre" => $cursoNombre,
        "instructorNombre" => $instructorName["nombre"],
        "questions" => App::resolve(PreguntaRepository::class)->getPreguntas(3),
        "cursoId" => $cursoId
    ]);
}

