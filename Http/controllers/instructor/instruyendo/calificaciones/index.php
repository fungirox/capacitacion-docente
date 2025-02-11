<?php

use Core\App;
use Core\Repositories\CursoDocenteRepository;
use Core\Session;

$alumnos = App::resolve(CursoDocenteRepository::class)->getDocentesFromCurso($_GET["id"], Session::getUser("id"));

return view("/instructor/instruyendo/calificaciones/index.view.php", [
    "title" => "Calificaciones",
    "id" => $_GET["id"],
    "alumnos" => $alumnos
]);
