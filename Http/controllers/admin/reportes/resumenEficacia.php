<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Repositories\EncuestaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\RespuestaPreguntaRepository;
use Core\Repositories\CursoDocenteRepository;

$cursoId = $_GET["id"];
$curso = App::resolve(CursoRepository::class)->getCursoConcluido($cursoId);

if ($curso) {
    $encuesta = App::resolve(EncuestaRepository::class)->getById(3);
    $instructorNombre = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
    $numeroParticipantes = App::resolve(CursoDocenteRepository::class)->getParticipantesCurso($cursoId);
    $numeroEvaluaciones = App::resolve(RespuestaRepository::class)->getCantidadRespuestas($cursoId, 3);
    $questions = App::resolve(RespuestaPreguntaRepository::class)->getRespuestas($cursoId, 3);
    $summatory = 0;
    date_default_timezone_set('America/Hermosillo');
    $todayDate = new DateTime();
    $formattedToday = $todayDate->format('d-m-Y');
    $horario = date("H:i A");

    ob_start();
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                    .tg .tg-kwiq {
                        border-color: inherit;
                        color: #000000;
                        text-align: left;
                        vertical-align: top
                    }

                    .tg .tg-lgs3 {
                        background-color: #c0c0c0;
                        border-color: inherit;
                        color: #000000;
                        font-weight: bold;
                        text-align: left;
                        vertical-align: top
                    }

                    .tg .tg-x4xk {
                        background-color: #c0c0c0;
                        border-color: inherit;
                        color: #000000;
                        font-weight: bold;
                        text-align: right;
                        vertical-align: top
                    }
                </style>
                <table class="tg">
                    <thead>
                        <tr>
                            <th class="tg-lgs3">Nombre del curso</th>
                            <th class="tg-kwiq" colspan="3"><?= $curso["CURSO_Nombre"] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tg-lgs3" colspan="2">Indicador</td>
                            <td class="tg-lgs3" colspan="2">Promedio</td>
                        </tr>
                        <?php foreach ($questions as $key => $pregunta): ?>
                            <tr>
                                <?php $summatory += $pregunta["Promedio"]; ?>
                                <td class="tg-kwiq" colspan="2"><?= $pregunta["PREGUNTA_Texto"] ?></td>
                                <td class="tg-kwiq" colspan="2"><?= round($pregunta["Promedio"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="tg-x4xk" colspan="2">Total</td>
                            <?php if(count($questions)>0){
                                    $summatory = round($summatory / count($questions));
                                }
                            ?>
                            <td class="tg-kwiq" colspan="2"><?= $summatory ?></td>
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
