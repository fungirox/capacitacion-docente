<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $surveyData['ENCUESTA_Nombre'] ?></title>
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
        <h2><?= $surveyData['ENCUESTA_Nombre'] ?></h2>
        <h1><?= $surveyData['ENCUESTA_Descripcion'] ?></h1>
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
            <td class="tg-w1ee" colspan="3"><?= $serviceName['CURSO_Nombre'] ?></th>
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
            <td class="tg-w1ee" colspan="3"><?= $instructorName['USER_Nombre'] ?></td>
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
            <td class="tg-v0hj" colspan="2">Instructor</td>
            <td class="tg-v0hj" colspan="2">Organización y logística</td>
          </tr>
          <tr>
            <td class="tg-v0hj">Rasgo a evaluar</td>
            <td class="tg-v0hj">Eval.</td>
            <td class="tg-v0hj">Rasgo a evaluar</td>
            <td class="tg-v0hj">Eval.</td>
          </tr>
          <?php
          // Contadores para separar las preguntas en dos columnas
          $columna1 = array_slice($questions, 0, 9); // Preguntas 1 a 9
          $columna2 = array_slice($questions, 9, 5); // Preguntas 10 a 14

          // Calcular el número de filas necesarias (máximo entre ambas columnas)
          $totalRows = max(count($columna1), count($columna2));
          ?>

          <?php for ($i = 0; $i < $totalRows; $i++): ?>
            <tr>
              <?php if (isset($columna1[$i])): 
                $summatoryInstructor += $columna1[$i]["Promedio"]; ?>
                <td class="tg-0pky">
                  <?= $columna1[$i]["PREGUNTA_Texto"] ?>
                </td>
                <td class="tg-0pky">
                  <?= $columna1[$i]["Promedio"] ?>
                </td>
              <?php endif; ?>
              <?php if (isset($columna2[$i])): 
                $summatoryOrganizacion += $columna2[$i]["Promedio"]; ?>
                  <td class="tg-0pky">
                  <?= $columna2[$i]["PREGUNTA_Texto"] ?>
                  </td>
                  <td class="tg-0pky">
                    <?= $columna2[$i]["Promedio"] ?>
                  </td>
              <?php else: ?>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
              <?php endif; ?>
            </tr>
          <?php endfor; ?>
          <tr>
            <td class="tg-9ck0">Evaluación promedio</td>
            <td class="tg-0pky"><?php $evaluacionInstructor = $summatoryInstructor/count($columna1);  ?><?= $evaluacionInstructor ?></td>
            <td class="tg-9ck0">Evaluación promedio</td>
            <td class="tg-0pky"><?php $evaluacionOrganizacion = $summatoryOrganizacion/count($columna2); ?><?= $evaluacionOrganizacion ?></td>
          </tr>
          <tr>
            <td class="tg-9ck0" colspan="3">Evaluación general</td>
            <td class="tg-0pky"><?= ($evaluacionInstructor + $evaluacionOrganizacion) / 2 ?></td>
          </tr>
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

require_once __DIR__ . '../../../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$mpdf -> WriteHTML($html_code);
$mpdf -> Output();
?>