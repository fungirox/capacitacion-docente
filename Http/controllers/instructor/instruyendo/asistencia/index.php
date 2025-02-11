<?php

use Core\App;
use Core\Repositories\AsistenciaCursoRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\CursoRepository;
use Core\Session;

$cursoId = $_GET["id"];

App::resolve(CursoRepository::class)->userIsInstructor(Session::getUser("id"), $cursoId);

$sessiones = App::resolve(AsistenciaCursoRepository::class)->getSessions($cursoId);
$nuevaSesion = $_GET["sesion"] == count($sessiones) + 1;

$alumnos = $nuevaSesion
    ? App::resolve(CursoDocenteRepository::class)->getDocentesFromCurso($cursoId)
    : App::resolve(CursoDocenteRepository::class)->getDocentesFromPreviousCurso($cursoId, $sessiones[$_GET["sesion"] - 1]["fecha"]);

$fecha = $nuevaSesion
    ? formatDate((new DateTime())->format("Y-m-d"))
    : formatDate($sessiones[$_GET["sesion"] - 1]["fecha"]);

if (empty($alumnos)) {
    redirect("/instruyendo");
}

if ((new DateTime())->format("Y-m-d") == end($sessiones)["fecha"] && $nuevaSesion) {
    redirect("/instruyendo/curso/asistencia?id=" . $cursoId . "&sesion=" . count($sessiones));
}

return view("/instructor/instruyendo/asistencia/index.view.php", [
    "nuevaSesion" => $nuevaSesion,
    "title" => "Asistencia",
    "date" => $fecha,
    "sesion" => $_GET["sesion"],
    "sesiones" => count($sessiones),
    "id" => $cursoId,
    "alumnos" => $alumnos
]);
