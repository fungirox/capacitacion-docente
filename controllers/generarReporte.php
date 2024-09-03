<?php
#if (!$_SESSION["loggedIn"]) {
#    header("Location: ../login.php");
#    die();
#}
# require_once '../config/connection.php';
# require_once "../config/config.php";

$db = new Database();
$idCurso = 1;
$surveyId = 1;

$surveyData = $db -> query("SELECT ENCUESTA_Nombre, ENCUESTA_Descripcion FROM tblEncuesta WHERE ENCUESTAID = ?;", [$surveyId]) -> getOrFail();



$encuestaQuery = "SELECT ENCUESTA_Nombre, ENCUESTA_Descripcion FROM tblEncuesta WHERE ENCUESTAID = :idEncuesta;";
$stnt = $connection->prepare($encuestaQuery);
$stnt->bindParam(':idEncuesta', $idEncuesta, PDO::PARAM_INT);
$stnt->execute();
$nombreEncuesta = $stnt->fetch(PDO::FETCH_ASSOC);

$serviceNameQuery = "SELECT CURSO_Nombre FROM tblCurso WHERE CURSOID = :idCurso;";
$stnt = $connection->prepare($serviceNameQuery);
$stnt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
$stnt->execute();
$serviceName = $stnt->fetch(PDO::FETCH_ASSOC);

$instructorNameQuery = "SELECT u.USER_Nombre
                        FROM tblCursoInstructor ci
                        JOIN tblInstructor i ON ci.INSTRUCTORID = i.INSTRUCTORID
                        JOIN tblUsuario u ON i.USERID = u.USERID
                        WHERE ci.CURSOID = :idCurso;";
$stnt = $connection->prepare($instructorNameQuery);
$stnt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
$stnt->execute();
$instructorName = $stnt->fetch(PDO::FETCH_ASSOC);


$docenteCountQuery = "SELECT COUNT(*) AS CantidadDocentes 
                      FROM tblCursoDocente 
                      WHERE CURSOID = :idCurso;";
$stnt = $connection->prepare($docenteCountQuery);
$stnt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
$stnt->execute();
$numeroParticipantes = $stnt->fetch(PDO::FETCH_ASSOC);

$respuestaCountQuery = "SELECT COUNT(*) AS CantidadRespuestas 
                        FROM tblRespuesta 
                        WHERE CURSOID = :idCurso AND ENCUESTAID = :idEncuesta;";
$stnt = $connection->prepare($respuestaCountQuery);
$stnt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
$stnt->bindParam(':idEncuesta', $idEncuesta, PDO::PARAM_INT);
$stnt->execute();
$numeroEvaluaciones = $stnt->fetch(PDO::FETCH_ASSOC);

$todayDate = new DateTime();
$formattedToday = $todayDate->format('d-m-Y');

date_default_timezone_set('America/Hermosillo');
$horario = date("H:i A");

$questionsQuery = "SELECT CAST(p.PREGUNTA_Texto AS VARCHAR(MAX)) AS PREGUNTA_Texto, 
       AVG(CAST(rp.RESPUESTAPREGUNTA_Texto AS FLOAT)) AS Promedio
        FROM tblRespuestaPregunta rp
        JOIN tblRespuesta r ON rp.RESPUESTAID = r.RESPUESTAID
        JOIN tblPregunta p ON rp.PREGUNTAID = p.PREGUNTAID
        WHERE r.ENCUESTAID = :idEncuesta 
        AND r.CURSOID = :idCurso
        AND ISNUMERIC(rp.RESPUESTAPREGUNTA_Texto) = 1
        GROUP BY p.PREGUNTAID, CAST(p.PREGUNTA_Texto AS VARCHAR(MAX))
        ORDER BY p.PREGUNTAID;";

$stnt = $connection->prepare($questionsQuery);
$stnt->bindParam(':idEncuesta', $idEncuesta, PDO::PARAM_INT);
$stnt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
$stnt->execute();
$questions = $stnt->fetchAll(PDO::FETCH_ASSOC);

$summatoryInstructor = 0;
$summatoryOrganizacion = 0;

require "../views/reporte.view.php";
