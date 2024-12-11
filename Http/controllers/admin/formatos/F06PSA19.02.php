<?php

use Core\App;
use Core\Database;
use Core\Router;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\UsuarioRepository;

$allCursos = App::resolve(CursoRepository::class)->getAllReporteITESCA();
date_default_timezone_set('America/Hermosillo');
$todayDate = new DateTime();
$formattedToday = $todayDate->format('d-m-Y');
require base_path("vendor/autoload.php");
$mpdf = new \Mpdf\Mpdf();
ob_start();
$totalHoras = 0;
$totalDocentes = 0;
$totalCalificaciones = 0;
if(count($allCursos)>0){
    foreach ($allCursos as $curso) {
        $totalHoras += $curso['CURSO_Total_Horas'];
        $totalDocentes += $curso['cantidad_docentes_total'];
        $totalCalificaciones += $curso['promedio_calificacion'];
    }
    $totalCalificaciones = round($totalCalificaciones / count($curso));
}


?>
<html>
<style type="text/css">
    body {
        font-family: Arial, sans-serif;
    }

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

    .tg .tg-baqh {
        text-align: center;
        vertical-align: top
    }

    .tg .tg-lqy6 {
        text-align: right;
        vertical-align: top
    }

    .tg .tg-0lax {
        text-align: left;
        vertical-align: top
    }
</style>

<body>
    <div class="document_header">
        <div class="document_description">
            <div><img src="C:\xampp\htdocs\capacitacion-docente\public\assets\images\icono-itesca-texto.png" alt="Logo de ITESCA" width="124" /></div>
            <div>
                <h2>F06PSA19.02</h2>
                <h1>INFORME ANUAL DEL PROGRAMA DE ACTUALIZACIÓN PROFESIONAL Y CAPACITACIÓN DOCENTE</h1>
            </div>
        </div>
    </div>
    <table class="tg">
        <tbody>
            <tr>
                <td class="tg-lqy6">Periodo Evaluado</td>
                <td class="tg-0lax" colspan="2"></td>
                <td class="tg-lqy6">Fecha de evaluación</td>
                <td class="tg-0lax" colspan="2"></td>
            </tr>
            <tr>
                <td class="tg-baqh">Eventos Programados</td>
                <td class="tg-baqh">Eventos Realizados</td>
                <td class="tg-baqh">Eventos cancelados</td>
                <td class="tg-baqh">Eventos Reprogramados</td>
                <td class="tg-baqh" colspan="2">% de Realización</td>
            </tr>
            <tr>
                <td class="tg-0lax"></td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax" colspan="2"></td>
            </tr>
            <tr>
                <td class="tg-baqh" colspan="6">Resumen</td>
            </tr>
            <tr>
                <td class="tg-baqh">Evento</td>
                <td class="tg-baqh">Periodo de realización</td>
                <td class="tg-baqh">Duración en Horas</td>
                <td class="tg-baqh">No de Asistentes</td>
                <td class="tg-baqh">Horas Persona</td>
                <td class="tg-baqh">Promedio de Evaluación</td>
            </tr>
            <?php foreach ($allCursos as $curso) : ?>
                <?php
                $id = htmlspecialchars($curso["CURSOID"]);
                $nombre = htmlspecialchars($curso["CURSO_Nombre"]);
                $periodo = htmlspecialchars($curso["Periodo"]);
                $total_docentes = htmlspecialchars($curso["cantidad_docentes_total"]);
                $duracion = ($curso["total_horas"]);
                $promedio = ($curso["promedio_calificacion"]);
                ?>
                <tr>
                    <td class="tg-0lax"><?= $nombre ?></td>
                    <td class="tg-0lax"><?= $periodo ?></td>
                    <td class="tg-0lax"><?= $duracion ?></td>
                    <td class="tg-0lax"><?= $total_docentes ?></td>
                    <td class="tg-0lax"></td>
                    <td class="tg-0lax"><?= $promedio ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="tg-0lax"></td>
                <td class="tg-lqy6">Totales</td>
                <td class="tg-0lax"><?= $totalHoras ?></td>
                <td class="tg-0lax"><?= $totalDocentes ?></td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax"><?= $totalCalificaciones ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>

<?php
$html_code = ob_get_clean();
$mpdf->WriteHTML($html_code);
$fileName = $formattedToday . " F06PSA19.02 " . ".pdf";
$mpdf->Output($fileName, 'D');
redirect("/admin/formatos");
exit();
