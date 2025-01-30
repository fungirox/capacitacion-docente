<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\ConstanciaRepository;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");

$constanciasDocente = App::resolve(ConstanciaRepository::class)->getAllAsDocente($userId);
$constanciasInstructor = App::resolve(ConstanciaRepository::class)->getAllAsInstructor($userId);

return view("/docenteOrInstructor/constancias/index.view.php", [
    "title" => "Constancias",
    "isDocenteAndInstructor" => $isDocenteAndInstructor,
    "constanciasDocente" => $constanciasDocente,
    "constanciasInstructor" => $constanciasInstructor
]);
