<?php
include '../config/connection.php';

$teachersQuery = "SELECT u.USERID, d.DOCENTEID, u.USER_Nombre, u.USER_Apellido FROM dbo.tblUsuario as u INNER JOIN dbo.tblDocente as d ON u.USERID = d.USERID;";
$areaQuery = "SELECT * FROM dbo.tblArea;";
$stnt = $connection->prepare($teachersQuery);
$stnt->execute();
$teachersData = $stnt->fetchAll();
$stnt = $connection->prepare($areaQuery);
$stnt->execute();
$areaData = $stnt->fetchAll();

$todayDate = new DateTime();
$formattedToday = $todayDate->format('Y-m-d');
$tomorrowDate = new DateTime('tomorrow');
$formattedTomorrow = $tomorrowDate->format('Y-m-d');

$weekdays = [
    'lunes' => 'Lunes',
    'martes' => 'Martes',
    'miercoles' => 'Miércoles',
    'jueves' => 'Jueves',
    'viernes' => 'Viernes'
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar servicio</title>
</head>

<body>
    <h1>Registrar servicio</h1>
    <form>
        <!--- Nombre del servicio --->
        <label for="service-name">Nombre de servicio</label>
        <input type="text" required placeholder="Nombre del curso" id="service-name" name="service-name" />
        <br />
        <!--- Tipo de servicio: curso, taller y diplomado --->
        <label for="service-type">Tipo de servicio</label>
        <input type="radio" required name="service-type" id="curso" value="curso" checked="checked" />
        <label for="curso">Curso</label>

        <input type="radio" required name="service-type" id="taller" value="taller" />
        <label for="taller">Taller</label>

        <input type="radio" required name="service-type" id="diplomado" value="diplomado" />
        <label for="diplomado">Diplomado</label>
        <br />
        <!--- Tipo de servicio: interno, externo --->
        <input type="radio" required name="service-category" id="interno" value="0" checked="checked" />
        <label for="interno">Interno</label>

        <input type="radio" required name="service-category" id="externo" value="1" />
        <label for="externo">Externo</label>
        <br />
        <!--- Seleccionar instructor --->
        <!--- Se selecciona desde la tabla docentes porque todos los docentes pueden ser instructores, 
            estos no son instructores hasta que sean asignados a un curso --->
        <label for="teachers">Instructores</label>
        <select name="teachers" id="teachers">
            <?php foreach ($teachersData as $row) : ?>
                <?php
                $userID = htmlspecialchars($row['USERID'], ENT_QUOTES, 'UTF-8');
                $userFirstName = htmlspecialchars($row['USER_Nombre'], ENT_QUOTES, 'UTF-8');
                $userLastName = htmlspecialchars($row['USER_Apellido'], ENT_QUOTES, 'UTF-8');
                ?>
                <option value="<?= $userID ?>"><?= $userFirstName ?> <?= $userLastName ?></option>
            <?php endforeach; ?>
        </select>
        <button>Agregar instructor</button>
        <br />
        <!-- Aquí falta lo de areas, aun no sé como hacerlo -->
        <label for="areas">Areas</label>
        <br />
        <?php foreach ($areaData as $row) : ?>
            <?php
            $areaSiglas = htmlspecialchars($row['AREA_Siglas'], ENT_QUOTES, 'UTF-8');
            $areaID = htmlspecialchars($row['AREAID'], ENT_QUOTES, 'UTF-8');
            ?>
            <input type="checkbox" name="areas" value="<?= $areaID ?>"><?= $areaSiglas ?><br />
        <?php endforeach; ?>

        <br />
        <!-- Horario -->
        <label for="physical-hours">Horas presenciales</label>
        <input type="number" min="0" required value="0" id="physical-hours" name="physical-hours" />
        <label for="virtual-hours">Horas virtuales</label>
        <input type="number" min="0" required value="0" id="virtual-hours" name="virtual-hours" />
        <br />
        <!-- Fechas -->
        <label for="start-date">Fecha de inicio</label>
        <input type="date" id="start-date" name="start-date" min="<?= $formattedToday; ?>" value="<?= $formattedToday; ?>"> <br />
        <label for="finish-date">Fecha de finalización</label>
        <input type="date" id="finish-date" name="finish-date" min="<?= $formattedToday; ?>" value="<?= $formattedTomorrow; ?>"> <br />
        <!--- Aula -->
        <!-- Si las horas presenciales son 0, no debe solicitar aula, en caso contrario es required -->
        <label for="classroom">Aula</label>
        <input type="number" min="0" id="classroom" name="classroom" />
        <br />
        <!--- Días de la semana -->
        <label for="week">Días de la semana</label> <br />
        <?php foreach ($weekdays as $id => $name) : ?>
            <input type="checkbox" id="<?= $id ?>" name="weekday[]" value="<?= $id ?>">
            <label for="<?= $id ?>"><?= $name ?></label><br />
        <?php endforeach; ?>
        <br />
    </form>
</body>

</html>