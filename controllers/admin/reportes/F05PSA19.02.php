<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$title = "F05PSA19.02";

$idCurso = 1; // Estos deberán mandarse al hacer request por ahora están así 
$surveyId = 1;

$surveyData = $db -> query("SELECT ENCUESTA_Nombre, ENCUESTA_Descripcion FROM tblEncuesta WHERE ENCUESTAID = ?", [$surveyId]) -> getOrFail();

$serviceName = $db->query("SELECT CURSO_Nombre FROM tblCurso WHERE CURSOID = ?;", [$idCurso]) -> getOrFail();

$instructorName = $db->query("SELECT u.USER_Nombre
                        FROM tblCursoInstructor ci
                        JOIN tblInstructor i ON ci.INSTRUCTORID = i.INSTRUCTORID
                        JOIN tblUsuario u ON i.USERID = u.USERID
                        WHERE ci.CURSOID = ?", [$idCurso]) -> getOrFail();

$numeroParticipantes = $db->query( "SELECT COUNT(*) AS CantidadDocentes 
                      FROM tblCursoDocente 
                      WHERE CURSOID = ?" , [$idCurso]) -> getOrFail();

$numeroEvaluaciones = $db->query( "SELECT COUNT(*) AS CantidadRespuestas 
                        FROM tblRespuesta 
                        WHERE CURSOID = ? AND ENCUESTAID = ?" , [$idCurso, $surveyId]) -> getOrFail();

$questionsQuery = "SELECT CAST(p.PREGUNTA_Texto AS VARCHAR(MAX)) AS PREGUNTA_Texto, 
       AVG(CAST(rp.RESPUESTAPREGUNTA_Texto AS FLOAT)) AS Promedio
        FROM tblRespuestaPregunta rp
        JOIN tblRespuesta r ON rp.RESPUESTAID = r.RESPUESTAID
        JOIN tblPregunta p ON rp.PREGUNTAID = p.PREGUNTAID
        WHERE r.ENCUESTAID = ?
        AND r.CURSOID = ?
        AND ISNUMERIC(rp.RESPUESTAPREGUNTA_Texto) = 1
        GROUP BY p.PREGUNTAID, CAST(p.PREGUNTA_Texto AS VARCHAR(MAX))
        ORDER BY p.PREGUNTAID;";

$questions = $db -> query($questionsQuery, [$surveyId, $idCurso]) -> getAll();

date_default_timezone_set('America/Hermosillo');
$todayDate = new DateTime();
$formattedToday = $todayDate->format('d-m-Y');
$horario = date("H:i A");
$summatoryInstructor = 0;
$summatoryOrganizacion = 0;

require view("admin/reportes/F05PSA19.02.view.php");