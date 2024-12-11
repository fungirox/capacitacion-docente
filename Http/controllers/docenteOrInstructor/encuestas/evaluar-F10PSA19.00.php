<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\RespuestaPreguntaRepository;

$db = App::resolve(Database::class);
$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;
$userId = Session::getUser("id");
$courseID = $_POST["CURSOID"];

$docenteId = App::resolve(DocenteRepository::class) -> getDocenteId($userId);
App::resolve(CursoDocenteRepository::class) -> updateEncuestaEvaluacion($docenteId["DOCENTEID"],$courseID);
App::resolve(RespuestaRepository::class) -> setRespuesta($docenteId["DOCENTEID"],2,$courseID);
$respuestasId = App::resolve(RespuestaRepository::class) -> getUltimoId();
$preguntasIds = App::resolve(PreguntaRepository::class) -> getPreguntas(2);

foreach ($preguntasIds as $row) {
    $preguntaId = $row["PREGUNTAID"];
    $respuestaTexto = htmlspecialchars($_POST[$preguntaId]);
    App::resolve(RespuestaPreguntaRepository::class)->setRespuestas($respuestaTexto, $respuestasId["RESPUESTAID"], $preguntaId);
}


header("location: /historial");
die();
