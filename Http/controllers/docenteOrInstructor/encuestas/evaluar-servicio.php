<?php

use Core\App;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\RespuestaPreguntaRepository;
use Core\Repositories\ConstanciaRepository;

// evaluar servicio

$usuarioId = Session::getUser("id");
$cursoId = $_POST["CURSOID"];
$encuestaId = $_POST["ENCUESTAID"];
$docenteId = App::resolve(DocenteRepository::class) -> getDocenteId($usuarioId);

App::resolve(RespuestaRepository::class) -> setRespuesta($docenteId["DOCENTEID"],$encuestaId,$cursoId);
$respuestasId = App::resolve(RespuestaRepository::class) -> getUltimoId();
$preguntasIds = App::resolve(PreguntaRepository::class) -> getPreguntas($encuestaId);
foreach ($preguntasIds as $row) {
    $preguntaId = $row["PREGUNTAID"];
    $respuestaTexto = htmlspecialchars($_POST[$preguntaId]);
    App::resolve(RespuestaPreguntaRepository::class)->setRespuestas($respuestaTexto, $respuestasId["RESPUESTAID"], $preguntaId);
}
App::resolve(CursoDocenteRepository::class) -> updateEncuestaEvaluacion($docenteId["DOCENTEID"],$cursoId);
App::resolve(ConstanciaRepository::class) -> setConstancia($cursoId,$usuarioId,1);
$constanciaId = App::resolve(ConstanciaRepository::class) -> getUltimoId();
$fechaInicio = App::resolve(CursoRepository::class) -> getFechaCursoById($cursoId);
$mes = date('n', strtotime($fechaInicio["CURSO_Fecha_Inicio"]));
$year = date('Y', strtotime($fechaInicio["CURSO_Fecha_Inicio"]));
    
$periodo = match(true) {
    $mes >= 1 && $mes <= 5 => 'Enero-Mayo',
    $mes >= 6 && $mes <= 7 => 'Verano',
    $mes >= 8 && $mes <= 12 => 'Agosto-Diciembre'
};
    
$folio = "{$periodo} {$year}-" . $constanciaId["CONSTANCIAID"];
App::resolve(ConstanciaRepository::class) -> setFolio($constanciaId["CONSTANCIAID"],$folio);

header("location: /historial");
die();
