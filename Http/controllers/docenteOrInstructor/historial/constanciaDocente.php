<?php

use Core\App;
use Core\Database;
use Core\Router;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\UsuarioRepository;

$db = App::resolve(Database::class);
$cursoId = $_GET["id"];
$userId = Session::getUser("id");
$userData = App::resolve(UsuarioRepository::class)->getById($userId);
$curso = App::resolve(CursoRepository::class)->getCursoConstancia($userId, $cursoId);
if ($curso) {
        $fecha = new DateTime($curso["CURSO_Fecha_Final"]);
        $mesesEs = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $mes = (int)$fecha->format('n') - 1;
        $fechaFormateada = $fecha->format('d') . ' DE ' . $mesesEs[$mes] . ' DE ' . $fecha->format('Y');
        $tipo = strtoupper($curso["CURSO_Tipo"]);
        require base_path("vendor/autoload.php");
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLFooter('<img style="text-align: center;" src="C:\xampp\htdocs\capacitacion-docente\public\assets\images\footer.jpg" alt="Logo de la SEP y TECNM" height="64" /><br><p style="text-align: left;">folio constancia</p>');
        $mpdf->SetHTMLHeader('<img style="text-align: center;" src="C:\xampp\htdocs\capacitacion-docente\public\assets\images\header.jpg" alt="Logo ITESCA" height="64" />');
        ob_start();
?>
        <html>

        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                        body {
                                font-family: Arial, sans-serif;
                                background-image: url("C:\xampp\htdocs\capacitacion-docente\public\assets\images\fondo-logo-sep.png");
                                background-size: cover;
                                background-repeat: no-repeat;
                                color: #595959;
                                text-align: center;
                        }

                        h1 {
                                font-size: 42px;
                        }

                        h2 {
                                font-size: xx-large;
                        }

                        h4 {
                                font-size: x-large;
                                font-weight: lighter;
                        }

                        h4 {
                                font-size: large;
                                font-weight: lighter;
                        }

                        .container {
                                margin: 12px;
                        }

                        .title,
                        .subtitle {
                                display: inline;
                                line-height: 1.1;
                                margin: 4px;
                        }

                        img {
                                padding: 0px 56px;
                        }
                </style>
        </head>

        <body>
                <br><br><br>
                <div class="container">
                        <h3 class="title">EL TECNOLÓGICO NACIONAL DE MÉXICO</h3>
                        <h4 class="subtitle">A TRAVÉS DEL INSTITUTO TECNOLÓGICO SUPERIOR DE CAJEME</h4>
                </div>
                <br>
                <div class="container">
                        <p class="subtitle">OTORGA LA PRESENTE</p>
                        <h3 class="title">CONSTANCIA</h3>
                        <p>A</p>
                </div>
                <div class="container">
                        <h1><?= $userData["USER_Nombre"] ?> <?= $userData["USER_Apellido"] ?></h1>
                </div>
                <div class="container">
                        <h4>POR HABER APROBADO SATISFACTORIAMENTE EL <?= $tipo ?>:</h4>
                </div>
                <div class="container">
                        <h2><?= $curso["CURSO_Nombre"] ?></h2>
                </div>
                <div class="container">
                        <h4>IMPARTIDO DEL <b><?= $fechaFormateada ?></b> DE <b>segunda fecha</b> EN EL INSTITUTO TECNOLÓGICO SUPERIOR DE CAJEME, CON UNA DURACIÓN DE <b>horas</b> EN LA MODALIDAD <b>modalidad</b>.</h4>
                </div>
                <br><br>
                <div class="container">
                        <h4 class="title">LIC. MARGARITA VÉLEZ DE LA ROCHA</h4>
                        <p class="subtitle">DIRECTORA GENERAL</p>
                </div>
        </body>

        </html>
<?php
        $html_code = ob_get_clean();
        $mpdf->WriteHTML($html_code);
        $fileName = $userData["USER_Nombre"] . " " . $userData["USER_Apellido"] . " - Constancia " .  $cursoId . ".pdf";
        $mpdf->Output($fileName, 'D');
        redirect("/admin/reportes");
        exit();
}
