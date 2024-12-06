<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\CursoDocenteRepository;
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

$preguntasIds = $_POST["questions"];

$preguntasIdsConsulta = [];
foreach ($preguntasIds as $row){
    $string = $row["PREGUNTAID"];
    $preguntasIdsConsulta[] = htmlspecialchars($_POST[$string]);
}

foreach ($preguntasIds as $index => $row) {
    $preguntaId = $row["PREGUNTAID"];
    $respuestaTexto = htmlspecialchars($_POST[$preguntaId]);
    App::resolve(RespuestaPreguntaRepository::class) -> setRespuestas($respuestaTexto,$respuestasId,$preguntaId);
}

header("location: /historial");
die();
