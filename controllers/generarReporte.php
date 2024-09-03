<?php
$db = new Database();
$idCurso = 1;
$surveyId = 1;

$surveyData = $db->query("SELECT ENCUESTA_Nombre, ENCUESTA_Descripcion FROM tblEncuesta WHERE ENCUESTAID = ?", [$surveyId])->getOrFail();

$encuestaQuery = "SELECT ENCUESTA_Nombre, ENCUESTA_Descripcion FROM tblEncuesta WHERE ENCUESTAID = ?";
$nombreEncuesta = $db->query($encuestaQuery, [$surveyId])->getOrFail();

$serviceNameQuery = "SELECT CURSO_Nombre FROM tblCurso WHERE CURSOID = ?;";
$serviceName = $db->query($serviceNameQuery, [$idCurso])->getOrFail();

$instructorNameQuery = "SELECT u.USER_Nombre
                        FROM tblCursoInstructor ci
                        JOIN tblInstructor i ON ci.INSTRUCTORID = i.INSTRUCTORID
                        JOIN tblUsuario u ON i.USERID = u.USERID
                        WHERE ci.CURSOID = ?";
$instructorName = $db->query($instructorNameQuery, [$idCurso])->getOrFail();


$docenteCountQuery = "SELECT COUNT(*) AS CantidadDocentes 
                      FROM tblCursoDocente 
                      WHERE CURSOID = ?";
$numeroParticipantes = $db->query($docenteCountQuery, [$idCurso])->getAll();

$respuestaCountQuery = "SELECT COUNT(*) AS CantidadRespuestas 
                        FROM tblRespuesta 
                        WHERE CURSOID = ? AND ENCUESTAID = ?";
$numeroEvaluaciones = $db->query($respuestaCountQuery, [$idCurso, $surveyId])->getAll();

$todayDate = new DateTime();
$formattedToday = $todayDate->format('d-m-Y');

date_default_timezone_set('America/Hermosillo');
$horario = date("H:i A");

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

$questions = $db->query($questionsQuery, [$surveyId, $idCurso])->getAll();

$summatoryInstructor = 0;
$summatoryOrganizacion = 0;

require "views/reporte.view.php";
