<?php

use Core\App;
use Core\Repositories\AsistenciaCursoRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\CursoRepository;
use Core\Session;

App::resolve(CursoRepository::class)->userIsInstructor(Session::getUser("id"), $_GET["id"]);

$sessiones = App::resolve(AsistenciaCursoRepository::class)->getSessions($_GET["id"]);
$nuevaSesion = $_GET["sesion"] == count($sessiones) + 1;

$alumnos = $nuevaSesion
    ? App::resolve(CursoDocenteRepository::class)->getDocentesFromCurso($_GET["id"])
    : App::resolve(CursoDocenteRepository::class)->getDocentesFromPreviousCurso($_GET["id"], $sessiones[$_GET["sesion"] - 1]["fecha"]);

$fecha = $nuevaSesion
    ? formatDate((new DateTime())->format("Y-m-d"))
    : formatDate($sessiones[$_GET["sesion"] - 1]["fecha"]);

return view("/instructor/instruyendo/asistencia/index.view.php", [
    "nuevaSesion" => $nuevaSesion,
    "title" => "Asistencia",
    "date" => $fecha,
    "sesion" => $_GET["sesion"],
    "id" => $_GET["id"],
    "alumnos" => $alumnos
]);
