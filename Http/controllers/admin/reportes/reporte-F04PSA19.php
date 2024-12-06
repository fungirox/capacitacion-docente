<?php

use Core\App;
use Core\Database;
use Core\Repositories\CursoRepository;
use Core\Repositories\EncuestaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\RespuestaPreguntaRepository;
use Core\Repositories\CursoDocenteRepository;

$db = App::resolve(Database::class);
$cursoId = $_GET["id"];
$curso = App::resolve(CursoRepository::class)->getCursoConcluido($cursoId);
if ($curso) {
        $modalidad = $curso["CURSO_Modalidad"] === "virtual";
        $encuesta = App::resolve(EncuestaRepository::class)->getById($modalidad ? 2 : 1);
        $instructorNombre = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
        $numeroParticipantes = App::resolve(CursoDocenteRepository::class)->getParticipantesCurso($cursoId);
        $numeroEvaluaciones = App::resolve(RespuestaRepository::class)->getCantidadRespuestas($cursoId, $modalidad ? 2 : 1);
        $questions = App::resolve(RespuestaPreguntaRepository::class)->getRespuestas($cursoId, $modalidad ? 2 : 1);

        date_default_timezone_set('America/Hermosillo');
        $todayDate = new DateTime();
        $formattedToday = $todayDate->format('d-m-Y');
        $horario = date("H:i A");
        $summatoryInstructor = 0;
        $summatoryOrganizacion = 0;

        ob_start();
?>
        <html>
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?= $encuesta['ENCUESTA_Nombre'] ?></title>
                <style>
                        body {
                                font-family: Helvetica, sans-serif;
                        }
                </style>
        </head>
        <body>
                <div class="document_header">
                        <div class="document_description">
                                <div><img src="C:\xampp\htdocs\capacitacion-docente\public\assets\images\icono-itesca-texto.png" alt="Logo de ITESCA" width="124" /></div>
                                <div>
                                        <h2><?= $encuesta['ENCUESTA_Nombre'] ?></h2>
                                        <h1>Resumen de <?= $encuesta['ENCUESTA_Descripcion'] ?></h1>
                                </div>
                        </div>

                </div>
                <div class="document_body">
                        <div class="document_info">
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

                                        .tg .tg-v0hj {
                                                background-color: #efefef;
                                                border-color: inherit;
                                                font-weight: bold;
                                                text-align: center;
                                                vertical-align: top;
                                        }

                                        .tg .tg-9ck0 {
                                                background-color: #efefef;
                                                border-color: inherit;
                                                font-weight: bold;
                                                text-align: right;
                                                vertical-align: top;
                                        }

                                        .tg .tg-2xhg {
                                                background-color: #efefef;
                                                border-color: #000000;
                                                color: #000000;
                                                font-family: Arial, Helvetica, sans-serif !important;
                                                font-weight: bold;
                                                text-align: right;
                                                vertical-align: top;
                                        }

                                        .tg .tg-w1ee {
                                                border-color: #000000;
                                                color: #000000;
                                                font-family: Arial, Helvetica, sans-serif !important;
                                                text-align: left;
                                                vertical-align: top;
                                        }

                                        .tg .tg-0pky {
                                                border-color: inherit;
                                                text-align: left;
                                                vertical-align: top;
                                        }
                                </style>
                                <table class="tg">
                                        <tbody>
                                                <!-- <thead> -->
                                                <tr>
                                                        <td class="tg-2xhg">Nombre del evento</th>
                                                        <td class="tg-w1ee" colspan="3"><?= $curso['CURSO_Nombre'] ?></th>
                                                </tr>
                                                <!-- </thead> -->
                                                <!-- <tbody> -->
                                                <tr>
                                                        <td class="tg-2xhg">Fecha</td>
                                                        <td class="tg-w1ee"><?= $formattedToday ?></td>
                                                        <td class="tg-2xhg">Horario</td>
                                                        <td class="tg-w1ee"><?= $horario ?></td>
                                                </tr>
                                                <tr>
                                                        <td class="tg-2xhg">Instructor o instructora</td>
                                                        <td class="tg-w1ee" colspan="3"><?= $instructorNombre['nombre'] ?></td>
                                                </tr>
                                                <tr>
                                                        <td class="tg-9ck0">No. de Participantes</td>
                                                        <td class="tg-0pky"><?= $numeroParticipantes['CantidadDocentes'] ?></td>
                                                        <td class="tg-9ck0">No. de Evaluaciones</td>
                                                        <td class="tg-0pky"><?= $numeroEvaluaciones['CantidadRespuestas'] ?></td>
                                                </tr>
                                                <tr>
                                                        <td class="tg-v0hj" colspan="4">
                                                                Promedio de las evaluaciones de cada rasgo evaluado
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <?php if ($modalidad == False): ?>
                                                                <td class="tg-v0hj" colspan="2">Instructor</td>
                                                                <td class="tg-v0hj" colspan="2">Organización y logística</td>
                                                        <?php else: ?>
                                                                <td class="tg-v0hj" colspan="4">Instructor</td>
                                                        <?php endif; ?>
                                                </tr>
                                                <tr>
                                                        <?php if ($modalidad == False): ?>
                                                                <td class="tg-v0hj">Rasgo a evaluar</td>
                                                                <td class="tg-v0hj">Eval.</td>
                                                                <td class="tg-v0hj">Rasgo a evaluar</td>
                                                                <td class="tg-v0hj">Eval.</td>
                                                        <?php else: ?>
                                                                <td class="tg-v0hj" colspan="3">Rasgo a evaluar</td>
                                                                <td class="tg-v0hj" colspan="1">Eval.</td>
                                                        <?php endif; ?>
                                                </tr>
                                                <?php if ($modalidad == False): ?>
                                                        <?php 
                                                        $columna1 = array_slice($questions, 0, 9); // Preguntas 1 a 9
                                                        $columna2 = array_slice($questions, 9, 5); // Preguntas 10 a 14
                                                        $totalRows = max(count($columna1), count($columna2));
                                                        for ($i = 0; $i < $totalRows; $i++): ?>
                                                                <tr>
                                                                        <?php if (isset($columna1[$i])):
                                                                                $summatoryInstructor += $columna1[$i]["Promedio"]; ?>
                                                                                <td class="tg-0pky">
                                                                                        <?= $columna1[$i]["PREGUNTA_Texto"] ?>
                                                                                </td>
                                                                                <td class="tg-0pky" style="text-align: center">
                                                                                        <?= round($columna1[$i]["Promedio"]) ?>
                                                                                </td>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($columna2[$i])):
                                                                                $summatoryOrganizacion += $columna2[$i]["Promedio"]; ?>
                                                                                <td class="tg-0pky">
                                                                                        <?= $columna2[$i]["PREGUNTA_Texto"] ?>
                                                                                </td>
                                                                                <td class="tg-0pky" style="text-align: center">
                                                                                        <?= round($columna2[$i]["Promedio"]) ?>
                                                                                </td>
                                                                        <?php else: ?>
                                                                                <td class="tg-0pky"></td>
                                                                                <td class="tg-0pky"></td>
                                                                        <?php endif; ?>
                                                                </tr>
                                                        <?php endfor; ?>
                                                <?php else: ?>
                                                        <?php foreach ($questions as $key => $pregunta): ?>
                                                                <?php $summatoryInstructor += $pregunta["Promedio"]; ?>
                                                                <td class="tg-9ck0" colspan="3">
                                                                        <?= $pregunta["PREGUNTA_Texto"] ?>
                                                                </td>
                                                                <td class="tg-0pky" colspan="1" style="text-align: center">
                                                                        <?= round($pregunta["Promedio"]) ?>
                                                                </td>
                                                        <?php endforeach; ?>
                                                <?php endif; ?>
                                                <tr>
                                                        <?php if ($modalidad == False): ?>
                                                                <td class="tg-9ck0">Evaluación promedio</td>
                                                                <td class="tg-0pky" style="text-align: center"><?php $evaluacionInstructor = round($summatoryInstructor / count($columna1));  ?><?= $evaluacionInstructor ?></td>
                                                                <td class="tg-9ck0">Evaluación promedio</td>
                                                                <td class="tg-0pky" style="text-align: center"><?php $evaluacionOrganizacion = round($summatoryOrganizacion / count($columna2)); ?><?= $evaluacionOrganizacion ?></td>
                                                        <?php else: ?>
                                                                <td class="tg-9ck0" colspan="3">Evaluación promedio</td>
                                                                <td class="tg-0pky" colspan="1" style="text-align: center">"placeholder"</td>
                                                        <?php endif; ?>

                                                </tr>
                                                <?php if ($modalidad == False): ?>
                                                        <tr>
                                                                <td class="tg-9ck0" colspan="3">Evaluación general</td>
                                                                <td class="tg-0pky" style="text-align: center"><?= ($evaluacionInstructor + $evaluacionOrganizacion) / 2 ?></td>
                                                        </tr>
                                                <?php endif; ?>
                                                <tr>
                                                        <td class="tg-0pky" colspan="4">
                                                                Análisis general y recomendaciones:
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                        </div>
                </div>
        </body>

        </html>
<?php

        $html_code = ob_get_clean();
        require base_path("vendor/autoload.php");
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html_code);
        $fileName = $formattedToday . "-" . $cursoId . "-" . $encuesta['ENCUESTA_Nombre'] . ".pdf";
        $mpdf->Output($fileName, 'D');
        redirect("/admin/reportes");
        exit();
}
