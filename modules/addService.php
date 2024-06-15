<?php
# TODO añadir el validar sesión
require_once '../config/connection.php';

function insertService($connection, $serviceName, $serviceType, $totalHours, $startDate, $finishDate, $serviceCategory, $serviceModality, $serviceActive, $serviceInProgress, $serviceProfile)
{
    # INSERT CURSO
    # El único campo que se llenará después es CURSO_Descripcion
    try {
        $queryInsertService = "INSERT INTO tblCurso (
            CURSO_Nombre,
            CURSO_Tipo,
            CURSO_Total_Horas,
            CURSO_Fecha_Inicio,
            CURSO_Fecha_Final,
            CURSO_Externo,
            CURSO_Modalidad,
            CURSO_Activo,
            CURSO_En_Progreso,
            CURSO_Perfil
            )
            VALUES (
            :serviceName, 
            :serviceType, 
            :serviceTotalHours, 
            :serviceStartDate, 
            :serviceFinishDate, 
            :serviceCategory, 
            :serviceModality, 
            :serviceActive, 
            :serviceInProgress, 
            :serviceProfile)";

        $stmt = $connection->prepare($queryInsertService);

        $stmt->bindParam(':serviceName', $serviceName);
        $stmt->bindParam(':serviceType', $serviceType);
        $stmt->bindParam(':serviceTotalHours', $totalHours);
        $stmt->bindParam(':serviceStartDate', $startDate);
        $stmt->bindParam(':serviceFinishDate', $finishDate);
        $stmt->bindParam(':serviceCategory', $serviceCategory);
        $stmt->bindParam(':serviceModality', $serviceModality);
        $stmt->bindParam(':serviceActive', $serviceActive);
        $stmt->bindParam(':serviceInProgress', $serviceInProgress);
        $stmt->bindParam(':serviceProfile', $serviceProfile);

        $stmt->execute();

        return $connection->lastInsertId();
    } catch (PDOException $e) {
        error_log("Error inserting service: " . $e->getMessage());
        return false;
    }
}

function insertServiceArea($connection, $serviceId, $areaId)
{
    try {
        $query = "INSERT INTO 
        tblCursoArea (
        CURSOID, 
        AREAID) 
        VALUES (
        :serviceId, 
        :areaId)";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(':serviceId', $serviceId);
        $stmt->bindParam(':areaId', $areaId);

        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error inserting service: " . $e->getMessage());
        return false;
    }
}

# falta verificar que todos los datos requeridos no sean None / Null
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceName = htmlspecialchars($_POST["service-name"]);
    $serviceType = htmlspecialchars($_POST["service-type"]);
    $serviceCategory = htmlspecialchars($_POST["service-category"]);
    $instructors = htmlspecialchars($_POST["teachers"]);
    $physicalHours = htmlspecialchars($_POST["physical-hours"]);
    $virtualHours = htmlspecialchars($_POST["virtual-hours"]);
    $startDate = htmlspecialchars($_POST["start-date"]);
    $finishDate = htmlspecialchars($_POST["finish-date"]);
    $classroom = htmlspecialchars($_POST["classroom"]);
    if (isset($_POST["areas"]) && is_array($_POST["areas"])) {
        $selectedAreas = $_POST["areas"];
    }
    if (isset($_POST["weekdays"]) && is_array($_POST["weekdays"])) {
        $selectedDays = $_POST["weekdays"];
    }

    # Por ahora las horas solo las sumaré para probar los inserts pero falta añadirlas a horario (solo presenciales)
    $totalHours = $physicalHours + $virtualHours;
    $serviceModality = "Virtual";
    if ($physicalHours > 0) {
        $serviceModality = ($virtualHours > 0) ? "Hibrido" : "Presencial";
    }

    $serviceId = insertService($connection, $serviceName, $serviceType, $totalHours, $startDate, $finishDate, $serviceCategory, $serviceModality, '1', '0', '0');

    #insert curso-area
    if ($serviceId != false) {
        foreach ($selectedAreas as $areaId) {
            insertServiceArea($connection, $serviceId, $areaId);
        }
    }

    #insert curso-instructor
    # Es necesario cambiar el diseño de la base de datos para los instructores y docentes 
    # parece ser que se añadirá una columna de activo a la tabla instructor para indicar si este está 
    # relacionado a un curso "activo". La consulta de "registrar-servicio" puede cambiar al INNER JOIN con 
    # instructores. 

}
# else mandar al index...