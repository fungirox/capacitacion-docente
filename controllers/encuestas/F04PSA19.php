<?php
# TODO añadir el validar sesión
require_once '../config/connection.php';
require_once "../config/config.php";

if (!$_SESSION["loggedIn"]) {
    header("Location: ../login.php");
    die();
}

# falta verificar que todos los datos requeridos no sean None / Null
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # LECTURA DE DATOS
    $teacherId = htmlspecialchars($_POST["teachers"]);
    $serviceId = 1; # $_POST["serviceId"]; temporalmente es 1 pero debemos enviarlo desde la pantalla anterior
    $encuestaId = 1; # igual que antes

    # Aquí necesitamos el id del curso que elegimos desde la interfaz de "historial" por ahora dejaré cursoid = 1
    $questionsQuery = "SELECT PREGUNTAID FROM tblPregunta where ENCUESTAID = '$encuestaId';";
    $stnt = $connection->prepare($questionsQuery);
    $stnt->execute();
    $questions = $stnt->fetchAll();

    $questionsCant = count($questions);
    $answers = [];
    foreach ($questions as $row) {
        $string = $row["PREGUNTAID"];
        $answers[] = htmlspecialchars($_POST[$string]);
    }

    try {
        $queryAnswers = "INSERT INTO 
        tblRespuesta (
        DOCENTEID,
        ENCUESTAID,
        CURSOID) 
        VALUES (
        :docenteId,
        :encuestaId,
        :cursoId)";

        $stmt = $connection->prepare($queryAnswers);
        $stmt->bindParam(":docenteId", $teacherId);
        $stmt->bindParam(":encuestaId", $encuestaId);
        $stmt->bindParam(":cursoId", $serviceId);
        $stmt->execute();
        $answersId = $connection->lastInsertId();

        try {
            $querySetAnswers = "INSERT INTO
            tblRespuestaPregunta (
                RESPUESTAPREGUNTA_Texto,
                RESPUESTAID,
                PREGUNTAID)
            VALUES
            (
                :RESPUESTASPREGUNTAS_Texto,
                :RESPUESTASID,
                :PREGUNTAID
            )
            ";

            foreach ($questions as $index => $question) {
                $stmt = $connection->prepare($querySetAnswers);
                $stmt->bindParam(":RESPUESTASPREGUNTAS_Texto", $answers[$index]);
                $stmt->bindParam(":RESPUESTASID", $answersId);
                $stmt->bindParam(":PREGUNTAID", $question['PREGUNTAID']);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            error_log("Error inserting service: " . $e->getMessage());
        }
    } catch (PDOException $e) {
        error_log("Error inserting service: " . $e->getMessage());
    }

    # Añade a la base de datos el registro de curso
    # $serviceId = insertService($connection, $serviceName, $serviceType, $totalHours, $startDate, $finishDate, $serviceCategory, $serviceModality, '1', '0', '0');

    # header("Location: ../templates/oferta.php");
}
# else mandar al index...
else {
    header("Location: ../login.php");
    die();
}
