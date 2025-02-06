<?php

use Core\App;
use Core\Session;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\RespuestaPreguntaRepository;

// eficacia de un servicio

$userId = Session::getUser("id");
$cursoId = $_POST["CURSOID"];
$docenteId = App::resolve(DocenteRepository::class) -> getDocenteId($userId);

App::resolve(CursoDocenteRepository::class) -> updateEncuestaEficacia($docenteId["DOCENTEID"],$cursoId);
App::resolve(RespuestaRepository::class) -> setRespuesta($docenteId["DOCENTEID"],3,$cursoId);
$respuestasId = App::resolve(RespuestaRepository::class) -> getUltimoId();
$preguntasIds = App::resolve(PreguntaRepository::class) -> getPreguntas(3);

foreach ($preguntasIds as $row) {
    $preguntaId = $row["PREGUNTAID"];
    $respuestaTexto = htmlspecialchars($_POST[$preguntaId]);
    App::resolve(RespuestaPreguntaRepository::class)->setRespuestas($respuestaTexto, $respuestasId["RESPUESTAID"], $preguntaId);
}

header("location: /historial");
die();
 