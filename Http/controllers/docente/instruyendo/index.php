<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$allCursos = App::resolve(CursoRepository::class)->getAllTeaching(Session::getUser("id"));

return view("/docente/instruyendo/index.view.php", [
    "title" => "Servicios Instruyendo",
    "allCursos" => $allCursos,
]);
