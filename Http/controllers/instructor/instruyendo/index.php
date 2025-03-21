<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$allCursos = App::resolve(CursoRepository::class)->getAllTeaching(Session::getUser("id"));
$allCursosSinEvaluar = App::resolve(CursoRepository::class)->getAllTerminados(Session::getUser("id"));

return view("/instructor/instruyendo/index.view.php", [
    "title" => "Cursos Instruyendo",
    "allCursos" => $allCursos,
    "allCursosSinEvaluar" => $allCursosSinEvaluar
]);
