<?php

use Core\App;
use Core\Session;
use Core\Repositories\CursoRepository;

$periodo = $_POST["periodoTEC"];
$year = $_POST["year"];
$periodoNombre = "";
switch ($periodo) {
    case '0':
        $fechaInicial = $year . "-01-01";
        $fechaFinal = $year . "-05-31";
        $periodoNombre = "de Enero a Mayo " . $year;
        break;
    case '1':
        $fechaInicial = $year . "-06-01";
        $fechaFinal = $year . "-07-31";
        $periodoNombre = "de Verano " . $year;
        break;
    case '2':
        $fechaInicial = $year . "-08-01";
        $fechaFinal = $year . "-12-31";
        $periodoNombre = "de Agosto a Septiembre " . $year;
        break;
    case '3':
        $fechaInicial = $_POST["fechaInicial"];
        $fechaFinal = $_POST["fechaFinal"];
        $periodoNombre = "Personalizado " . $year;
    default:
        break;
}

$allCursos = App::resolve(CursoRepository::class)->getAllReporteTECNM($fechaInicial,$fechaFinal);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename=FD_AP_2022 Formato TecNM " . $periodoNombre . ".xls");

//faltaría revisar que las fechas sean validas?


?>
<html>
<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg .tg-c3ow {
        border-color: inherit;
        text-align: center;
        vertical-align: top
    }

    .tg .tg-dvpl {
        border-color: inherit;
        text-align: right;
        vertical-align: top
    }

    .tg .tg-0pky {
        border-color: inherit;
        text-align: left;
        vertical-align: top
    }
</style>
<table class="tg">
    <thead>
        <tr>
            <th class="tg-dvpl">Nombre del Instituto Tecnológico</th>
            <th class="tg-0pky" colspan="2">Instituto Tecnológico Superior de Cajeme</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="tg-dvpl">Federal / Descentralizado</td>
            <td class="tg-0pky">Descentralizado</td>
        </tr>
        <tr>
            <td class="tg-dvpl">Estado / Entidad</td>
            <td class="tg-0pky">Sonora</td>
        </tr>
        <tr>
            <td class="tg-dvpl">Nombre Corto</td>
            <td class="tg-0pky">Cajeme</td>
        </tr>
        <tr>
            <td class="tg-dvpl">Número de IT asignado para control exclusivo de este proceso</td>
            <td class="tg-0pky">188</td>
        </tr>
        <tr>
            <td class="tg-c3ow">Nombre del Curso</td>
            <td class="tg-c3ow">Periodo de impartición del curso</td>
            <td class="tg-c3ow">Tipo de Servicio</td>
            <td class="tg-c3ow">Perfil del Curso</td>
            <td class="tg-c3ow">Modalidad de Impartición</td>
            <td class="tg-c3ow">Nombre del Instructor</td>
            <td class="tg-c3ow">Maximo Grado de Estudios del Instructor</td>
            <td class="tg-c3ow">Total de Participantes<br>(Hombres)</td>
            <td class="tg-c3ow">Total de Participantes<br>(Mujeres)</td>
            <td class="tg-c3ow">Número de participantes con conclusión satisfactoria<br></td>
            <td class="tg-c3ow">Codigo del Curso</td>
            <td class="tg-c3ow" colspan="3">Bloque de constancias</td>
        </tr>
        <?php foreach ($allCursos as $curso) : ?>
            <?php
            $id = htmlspecialchars($curso["CURSOID"]);
            $nombre = htmlspecialchars($curso["CURSO_Nombre"]);
            $periodo = htmlspecialchars($curso["Periodo"]);
            $tipo = Ucfirst(htmlspecialchars($curso["tipo"]));
            $perfil = htmlspecialchars($curso["CURSO_Perfil"]) == 1 ? "Actualización Profesional" : "Formación Docente";
            $modalidad = Ucfirst(htmlspecialchars($curso["CURSO_Modalidad"]));
            $instructor = htmlspecialchars($curso["instructor_nombre"]);
            $docentes_masculinos = htmlspecialchars($curso["cantidad_docentes_masculinos"]);
            $docentes_femeninos = htmlspecialchars($curso["cantidad_docentes_femeninos"]);
            $total_docentes = htmlspecialchars($curso["cantidad_docentes_total"]);
            $primerFolio = htmlspecialchars($curso["primer_folio"]);
            $ultimoFolio = htmlspecialchars($curso["ultimo_folio"]);
            ?>
            <tr>
                <td class="tg-c3ow"><?= $nombre ?></td>
                <td class="tg-c3ow"><?= $periodo ?></td>
                <td class="tg-c3ow"><?= $tipo ?></td>
                <td class="tg-c3ow"><?= $perfil ?></td>
                <td class="tg-c3ow"><?= $modalidad ?></td>
                <td class="tg-c3ow"><?= $instructor ?></td>
                <td class="tg-c3ow"></td>
                <td class="tg-c3ow"><?= $docentes_masculinos ?></td>
                <td class="tg-c3ow"><?= $docentes_femeninos ?></td>
                <td class="tg-c3ow"><?= $total_docentes ?></td>
                <td class="tg-c3ow"><?= $id ?></td>
                <td class="tg-c3ow"><?= $primerFolio ?></td>
                <td class="tg-c3ow">al</td>
                <td class="tg-c3ow"><?= $ultimoFolio ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 

</html>