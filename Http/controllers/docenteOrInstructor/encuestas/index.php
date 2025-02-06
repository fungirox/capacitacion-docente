<?php

use Core\App;
use Core\Session;
use Core\Repositories\CursoRepository;

$usuarioId = Session::getUser("id");
$cursosNoEvaluados = App::resolve(CursoRepository::class)-> getCursosNoEvaluados($usuarioId);
$cursosSinEficacia = App::resolve(CursoRepository::class)-> getCursosSinEficacia($usuarioId);

return view("/docenteOrInstructor/encuestas/index.view.php", [
    "title" => "Evaluaciones Pendientes",
    "cursosNoEvaluados" => $cursosNoEvaluados,
    "cursosSinEficacia" => $cursosSinEficacia
]);
