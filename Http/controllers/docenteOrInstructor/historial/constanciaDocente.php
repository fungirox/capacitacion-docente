<?php

use Core\App;
use Core\Database;
use Core\Repositories\ConstanciaRepository;
use Core\Router;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\PersonalRepository;
use Core\Repositories\UsuarioRepository;

$db = App::resolve(Database::class);
$constanciaId = $_GET["id"];
$constancia = App::resolve(ConstanciaRepository::class)->getById($constanciaId);

if ($constancia) {
        $userId = Session::getUser("id");
        $userData = App::resolve(UsuarioRepository::class)->getById($userId);

        $cursoId = $constancia["CURSOID"];
        $curso = App::resolve(CursoRepository::class)->getCursoConstancia($userId, $cursoId);

        $personalId = $constancia["PERSONALID"];
        $personalData = App::resolve(PersonalRepository::class)->getById($personalId);
        
        $fechaInicio = new DateTime($curso["CURSO_Fecha_Inicio"]);
        $mesesEs = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $mes = (int)$fechaInicio->format('n') - 1;
        $fechaInicioFormateada = $fechaInicio->format('d') . ' DE ' . $mesesEs[$mes] . ' DE ' . $fechaInicio->format('Y');

        $fechaFinal = new DateTime($curso["CURSO_Fecha_Final"]);
        $mesesEs = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $mes = (int)$fechaFinal->format('n') - 1;
        $fechaFinalFormateada = $fechaFinal->format('d') . ' DE ' . $mesesEs[$mes] . ' DE ' . $fechaFinal->format('Y');

        $tipo = strtoupper($curso["CURSO_Tipo"]);
        $modalidad = strtoupper($curso["CURSO_Modalidad"]) === 'MIXTO' ? 'MIXTA' : strtoupper($curso["CURSO_Modalidad"]);
        $totalHoras = strtoupper($curso["CURSO_Total_Horas"]);

        $personalTitulo = strtoupper($personalData["PERSONAL_Titulo"]);
        $personalNombre = strtoupper($personalData["PERSONAL_Nombre"]);
        $personalPuesto = mb_strtoupper($personalData["PERSONAL_Puesto"]);

        $constanciaFolio = $constancia["CONSTANCIA_Folio"];

        require base_path("vendor/autoload.php");
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLFooter('<img style="text-align: center;" src="C:\xampp\htdocs\capacitacion-docente\public\assets\images\footer.jpg" alt="Logo de la SEP y TECNM" height="64" /><br><p style="text-align: left;">' . $constanciaFolio . '</p>');
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
                        <h4>IMPARTIDO DEL <b><?= $fechaInicioFormateada ?></b> AL <b><?= $fechaFinalFormateada ?></b> EN EL INSTITUTO TECNOLÓGICO SUPERIOR DE CAJEME, CON UNA DURACIÓN DE <b><?= $totalHoras ?></b> HORAS EN LA MODALIDAD <b><?= $modalidad ?></b>.</h4>
                </div>
                <br><br>
                <div class="container">
                        <h4 class="title"><?= $personalTitulo ?>. <?= $personalNombre ?></h4>
                        <p class="subtitle"><?= $personalPuesto ?></p>
                </div>
        </body>

        </html>
<?php
        $html_code = ob_get_clean();
        $mpdf->WriteHTML($html_code);
        $fileName = $constancia["CONSTANCIA_Folio"] . " - Constancia " .  $cursoId . ".pdf";
        $mpdf->Output($fileName, 'D');
        redirect("/admin/reportes");
        exit();
}
