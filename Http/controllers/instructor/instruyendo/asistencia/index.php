<?php

use Core\App;
use Core\Repositories\CursoDocenteRepository;

$alumnos = App::resolve(CursoDocenteRepository::class)->getDocentesFromCurso($_GET["id"]);

return view("/instructor/instruyendo/asistencia/index.view.php", [
    "title" => "Asistencia",
    "alumnos" => $alumnos
]);

