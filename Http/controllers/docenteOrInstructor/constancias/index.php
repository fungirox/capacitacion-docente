<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;
use Core\Repositories\CursoRepository;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");

$cursosConcluidos = App::resolve(CursoRepository::class)->getCursosConcluidos($userId);

return view("/docenteOrInstructor/constancias/index.view.php", [
    "title" => "Constancias",
    "cursosConcluidos" => $cursosConcluidos
]);
