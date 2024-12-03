<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
dd("evaluar2");
$courseID = $_POST["CURSOID"];

$docenteId = $db->query("SELECT d.DOCENTEID
                          FROM tblUsuario u
                          JOIN tblDocente d ON u.USERID = d.USERID
                          WHERE u.USER_NombreUsuario = ?",
                          [$_SESSION["user"]["username"]]) ->get();

$db->query(
    "UPDATE tblCursoDocente SET CURSODOCENTE_EncuestaEvaluacion = 1 WHERE CURSOID = ? AND DOCENTEID = ?",
    [$courseID, $docenteId["DOCENTEID"]]
);

$db->query(
    "INSERT INTO tblRespuesta (DOCENTEID,ENCUESTAID,CURSOID) 
    VALUES (?,?,?)",
    [$docenteId["DOCENTEID"], 1, $courseID]
);

$respuestasId = $db->query(
    "SELECT TOP 1 RESPUESTAID FROM tblRespuesta ORDER BY RESPUESTAID DESC;"
)->get();

$preguntasIds = $db->query(
    "SELECT PREGUNTAID FROM tblPregunta where ENCUESTAID = '1';"
)->getAll();

$preguntasIdsConsulta = [];
foreach ($preguntasIds as $row){
    $string = $row["PREGUNTAID"];
    $preguntasIdsConsulta[] = htmlspecialchars($_POST[$string]);
}

foreach ($preguntasIds as $index => $row) {
    $preguntaId = $row["PREGUNTAID"];
    
    $respuestaTexto = htmlspecialchars($_POST[$preguntaId]);

    $db->query(
        "INSERT INTO tblRespuestaPregunta (RESPUESTAPREGUNTA_Texto, RESPUESTAID, PREGUNTAID) 
         VALUES (?, ?, ?)", 
        [$respuestaTexto, $respuestasId["RESPUESTAID"], $preguntaId]
    );
}

header("location: /historial");
die();
