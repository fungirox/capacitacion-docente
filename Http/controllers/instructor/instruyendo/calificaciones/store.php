<?php

use Core\App;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\ConstanciaRepository;

// update tabla curso docente
// change estado del curso

App::resolve(CursoDocenteRepository::class)->updateCalificacion(
    array_values($_POST["alumnos"]),
    $_POST["id"],
    array_keys($_POST["alumnos"])
);

App::resolve(CursoRepository::class)->updateState($_POST["id"], "calificado");
$usuarioId = Session::getUser("id");
App::resolve(ConstanciaRepository::class)->setConstancia($_POST["id"],$usuarioId,0);
App::resolve(CursoRepository::class)->updatePersonal($_POST["id"],$_POST["personal"]);

redirect("/instruyendo");
