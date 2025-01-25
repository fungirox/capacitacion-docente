<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;
use Core\Repositories\CursoRepository;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");

$cursosNoEvaluados = App::resolve(CursoRepository::class)->getCursosNoEvaluados($userId);
$cursosSinEficacia = App::resolve(CursoRepository::class)-> getCursosSinEficacia($userId);

return view("/docenteOrInstructor/historial/index.view.php", [
    "title" => "Historial de Cursos",
    "isDocenteAndInstructor" => $isDocenteAndInstructor,
    "cursosNoEvaluados" => $cursosNoEvaluados,
    "cursosSinSegundaEncuesta" => $cursosSinEficacia
]);
