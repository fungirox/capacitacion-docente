<?php
    $curso_name = "Taller de construcción para principantes en Fortnite: Battle Royale";
    $instructor_name = "José Diego Rascón Amador";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F04PSA19.02</title>
</head>

<body>
    <div>
        <p>F04PSA19.02</p>
        <h3>Evaluar servicio</h3>
        <h1><?php echo $curso_name ?></h1>
        <p>Por <?php echo $instructor_name ?></p>
    </div>
    <p>Por favor, responda el siguiente cuestionario de la manera más objetiva. Seleccione un número del 1 al 5 considerando que: 1 es muy malo y 5 excelente, elija el que mejor describa su percepción del evento.</p>
    <div>
        <h3>Evaluación de instructor</h3>
        <!-- Pregunta 1 -->
        <div>
            <label for="e_1_p_1">La o el instructor inició en los primeros 10 minutos</label>
            <input type="radio" id="e_1_p_1_1" required name="e_1_p_1" value="e_1_p_1_1" /> <label for="e_1_p_1_1">1</label>
            <input type="radio" id="e_1_p_1_2" required name="e_1_p_1" value="e_1_p_1_2" /> <label for="e_1_p_1_2">2</label>
            <input type="radio" id="e_1_p_1_3" required name="e_1_p_1" value="e_1_p_1_3" /> <label for="e_1_p_1_3">3</label>
            <input type="radio" id="e_1_p_1_4" required name="e_1_p_1" value="e_1_p_1_4" /> <label for="e_1_p_1_4">4</label>
            <input type="radio" id="e_1_p_1_5" required name="e_1_p_1" value="e_1_p_1_5" /> <label for="e_1_p_1_5">5</label>
        </div>
        <!-- Pregunta 2 -->
        <div>
            <label for="e_1_p_2">Se presentó el objetivo y programa</label>
            <input type="radio" id="e_1_p_2_1" required name="e_1_p_2" value="e_1_p_2_1" /> <label for="e_1_p_2_1">1</label>
            <input type="radio" id="e_1_p_2_2" required name="e_1_p_2" value="e_1_p_2_2" /> <label for="e_1_p_2_2">2</label>
            <input type="radio" id="e_1_p_2_3" required name="e_1_p_2" value="e_1_p_2_3" /> <label for="e_1_p_2_3">3</label>
            <input type="radio" id="e_1_p_2_4" required name="e_1_p_2" value="e_1_p_2_4" /> <label for="e_1_p_2_4">4</label>
            <input type="radio" id="e_1_p_2_5" required name="e_1_p_2" value="e_1_p_2_5" /> <label for="e_1_p_2_5">5</label>
        </div>
        <!-- Pregunta 3 -->
        <div>
            <label for="e_1_p_3">La explicación fue clara y completa</label>
            <input type="radio" id="e_1_p_3_1" required name="e_1_p_3" value="e_1_p_3_1" /> <label for="e_1_p_3_1">1</label>
            <input type="radio" id="e_1_p_3_2" required name="e_1_p_3" value="e_1_p_3_2" /> <label for="e_1_p_3_2">2</label>
            <input type="radio" id="e_1_p_3_3" required name="e_1_p_3" value="e_1_p_3_3" /> <label for="e_1_p_3_3">3</label>
            <input type="radio" id="e_1_p_3_4" required name="e_1_p_3" value="e_1_p_3_4" /> <label for="e_1_p_3_4">4</label>
            <input type="radio" id="e_1_p_3_5" required name="e_1_p_3" value="e_1_p_3_5" /> <label for="e_1_p_3_5">5</label>
        </div>
        <!-- Pregunta 4 -->
        <div>
            <label for="e_1_p_4">La o el instructor domina el tema</label>
            <input type="radio" id="e_1_p_4_1" required name="e_1_p_4" value="e_1_p_4_1" /> <label for="e_1_p_4_1">1</label>
            <input type="radio" id="e_1_p_4_2" required name="e_1_p_4" value="e_1_p_4_2" /> <label for="e_1_p_4_2">2</label>
            <input type="radio" id="e_1_p_4_3" required name="e_1_p_4" value="e_1_p_4_3" /> <label for="e_1_p_4_3">3</label>
            <input type="radio" id="e_1_p_4_4" required name="e_1_p_4" value="e_1_p_4_4" /> <label for="e_1_p_4_4">4</label>
            <input type="radio" id="e_1_p_4_5" required name="e_1_p_4" value="e_1_p_4_5" /> <label for="e_1_p_4_5">5</label>
        </div>
        <!-- Pregunta 5 -->
        <div>
            <label for="e_1_p_5">La exposición fue interesante y amena</label>
            <input type="radio" id="e_1_p_5_1" required name="e_1_p_5" value="e_1_p_5_1" /> <label for="e_1_p_5_1">1</label>
            <input type="radio" id="e_1_p_5_2" required name="e_1_p_5" value="e_1_p_5_2" /> <label for="e_1_p_5_2">2</label>
            <input type="radio" id="e_1_p_5_3" required name="e_1_p_5" value="e_1_p_5_3" /> <label for="e_1_p_5_3">3</label>
            <input type="radio" id="e_1_p_5_4" required name="e_1_p_5" value="e_1_p_5_4" /> <label for="e_1_p_5_4">4</label>
            <input type="radio" id="e_1_p_5_5" required name="e_1_p_5" value="e_1_p_5_5" /> <label for="e_1_p_5_5">5</label>
        </div>
        <!-- Pregunta 6 -->
        <div>
            <label for="e_1_p_6">Se brindó el material adecuado a los participantes</label>
            <input type="radio" id="e_1_p_6_1" required name="e_1_p_6" value="e_1_p_6_1" /> <label for="e_1_p_6_1">1</label>
            <input type="radio" id="e_1_p_6_2" required name="e_1_p_6" value="e_1_p_6_2" /> <label for="e_1_p_6_2">2</label>
            <input type="radio" id="e_1_p_6_3" required name="e_1_p_6" value="e_1_p_6_3" /> <label for="e_1_p_6_3">3</label>
            <input type="radio" id="e_1_p_6_4" required name="e_1_p_6" value="e_1_p_6_4" /> <label for="e_1_p_6_4">4</label>
            <input type="radio" id="e_1_p_6_5" required name="e_1_p_6" value="e_1_p_6_5" /> <label for="e_1_p_6_5">5</label>
        </div>
        <!-- Pregunta 7 -->
        <div>
            <label for="e_1_p_7">La presentación y apoyos fueron adecuados</label>
            <input type="radio" id="e_1_p_7_1" required name="e_1_p_7" value="e_1_p_7_1" /> <label for="e_1_p_7_1">1</label>
            <input type="radio" id="e_1_p_7_2" required name="e_1_p_7" value="e_1_p_7_2" /> <label for="e_1_p_7_2">2</label>
            <input type="radio" id="e_1_p_7_3" required name="e_1_p_7" value="e_1_p_7_3" /> <label for="e_1_p_7_3">3</label>
            <input type="radio" id="e_1_p_7_4" required name="e_1_p_7" value="e_1_p_7_4" /> <label for="e_1_p_7_4">4</label>
            <input type="radio" id="e_1_p_7_5" required name="e_1_p_7" value="e_1_p_7_5" /> <label for="e_1_p_7_5">5</label>
        </div>
        <!-- Pregunta 8 -->
        <div>
            <label for="e_1_p_8">Los conocimientos y habilidades desarrollados tienen aplicación inmediata o a corto plazo en mi trabajo</label>
            <input type="radio" id="e_1_p_8_1" required name="e_1_p_8" value="e_1_p_8_1" /> <label for="e_1_p_8_1">1</label>
            <input type="radio" id="e_1_p_8_2" required name="e_1_p_8" value="e_1_p_8_2" /> <label for="e_1_p_8_2">2</label>
            <input type="radio" id="e_1_p_8_3" required name="e_1_p_8" value="e_1_p_8_3" /> <label for="e_1_p_8_3">3</label>
            <input type="radio" id="e_1_p_8_4" required name="e_1_p_8" value="e_1_p_8_4" /> <label for="e_1_p_8_4">4</label>
            <input type="radio" id="e_1_p_8_5" required name="e_1_p_8" value="e_1_p_8_5" /> <label for="e_1_p_8_5">5</label>
        </div>
    </div>
    <div>
        <h3>Evaluación de organización y logísitca</h3>
        <!-- Pregunta 1 -->
        <div>
            <label for="e_2_p_1">La organización del evento fue</label>
            <input type="radio" id="e_2_p_1_1" required name="e_2_p_1" value="e_2_p_1_1" /> <label for="e_2_p_1_1">1</label>
            <input type="radio" id="e_2_p_1_2" required name="e_2_p_1" value="e_2_p_1_2" /> <label for="e_2_p_1_2">2</label>
            <input type="radio" id="e_2_p_1_3" required name="e_2_p_1" value="e_2_p_1_3" /> <label for="e_2_p_1_3">3</label>
            <input type="radio" id="e_2_p_1_4" required name="e_2_p_1" value="e_2_p_1_4" /> <label for="e_2_p_1_4">4</label>
            <input type="radio" id="e_2_p_1_5" required name="e_2_p_1" value="e_2_p_1_5" /> <label for="e_2_p_1_5">5</label>
        </div>
        <!-- Pregunta 2 -->
        <div>
            <label for="e_2_p_2">El lugar fue adecuado y confortable</label>
            <input type="radio" id="e_2_p_2_1" required name="e_2_p_2" value="e_2_p_2_1" /> <label for="e_2_p_2_1">1</label>
            <input type="radio" id="e_2_p_2_2" required name="e_2_p_2" value="e_2_p_2_2" /> <label for="e_2_p_2_2">2</label>
            <input type="radio" id="e_2_p_2_3" required name="e_2_p_2" value="e_2_p_2_3" /> <label for="e_2_p_2_3">3</label>
            <input type="radio" id="e_2_p_2_4" required name="e_2_p_2" value="e_2_p_2_4" /> <label for="e_2_p_2_4">4</label>
            <input type="radio" id="e_2_p_2_5" required name="e_2_p_2" value="e_2_p_2_5" /> <label for="e_2_p_2_5">5</label>
        </div>
        <!-- Pregunta 3 -->
        <div>
            <label for="e_2_p_3">Las condiciones de iluminación, ruido y temperatura fueron apropiadas</label>
            <input type="radio" id="e_2_p_3_1" required name="e_2_p_3" value="e_2_p_3_1" /> <label for="e_2_p_3_1">1</label>
            <input type="radio" id="e_2_p_3_2" required name="e_2_p_3" value="e_2_p_3_2" /> <label for="e_2_p_3_2">2</label>
            <input type="radio" id="e_2_p_3_3" required name="e_2_p_3" value="e_2_p_3_3" /> <label for="e_2_p_3_3">3</label>
            <input type="radio" id="e_2_p_3_4" required name="e_2_p_3" value="e_2_p_3_4" /> <label for="e_2_p_3_4">4</label>
            <input type="radio" id="e_2_p_3_5" required name="e_2_p_3" value="e_2_p_3_5" /> <label for="e_2_p_3_5">5</label>
        </div>
        <!-- Pregunta 4 -->
        <div>
            <label for="e_2_p_4">Si hubo servicio de cafetería este fue</label>
            <input type="radio" id="e_2_p_4_1" required name="e_2_p_4" value="e_2_p_4_1" /> <label for="e_2_p_4_1">1</label>
            <input type="radio" id="e_2_p_4_2" required name="e_2_p_4" value="e_2_p_4_2" /> <label for="e_2_p_4_2">2</label>
            <input type="radio" id="e_2_p_4_3" required name="e_2_p_4" value="e_2_p_4_3" /> <label for="e_2_p_4_3">3</label>
            <input type="radio" id="e_2_p_4_4" required name="e_2_p_4" value="e_2_p_4_4" /> <label for="e_2_p_4_4">4</label>
            <input type="radio" id="e_2_p_4_5" required name="e_2_p_4" value="e_2_p_4_5" /> <label for="e_2_p_4_5">5</label>
        </div>
        <!-- Pregunta 5 -->
        <div>
            <label for="e_2_p_5">La o el instructor solucionó las dudas</label>
            <input type="radio" id="e_2_p_5_1" required name="e_2_p_5" value="e_2_p_5_1" /> <label for="e_2_p_5_1">1</label>
            <input type="radio" id="e_2_p_5_2" required name="e_2_p_5" value="e_2_p_5_2" /> <label for="e_2_p_5_2">2</label>
            <input type="radio" id="e_2_p_5_3" required name="e_2_p_5" value="e_2_p_5_3" /> <label for="e_2_p_5_3">3</label>
            <input type="radio" id="e_2_p_5_4" required name="e_2_p_5" value="e_2_p_5_4" /> <label for="e_2_p_5_4">4</label>
            <input type="radio" id="e_2_p_5_5" required name="e_2_p_5" value="e_2_p_5_5" /> <label for="e_2_p_5_5">5</label>
        </div>
        <!-- Pregunta 6 -->
        <div>
            <label for="e_2_p_6">El horario y la duración de las sesiones fueron apropiadas</label>
            <input type="radio" id="e_2_p_6_1" required name="e_2_p_6" value="e_2_p_6_1" /> <label for="p_6_1">1</label>
            <input type="radio" id="e_2_p_6_2" required name="e_2_p_6" value="e_2_p_6_2" /> <label for="p_6_2">2</label>
            <input type="radio" id="e_2_p_6_3" required name="e_2_p_6" value="e_2_p_6_3" /> <label for="p_6_3">3</label>
            <input type="radio" id="e_2_p_6_4" required name="e_2_p_6" value="e_2_p_6_4" /> <label for="p_6_4">4</label>
            <input type="radio" id="e_2_p_6_5" required name="e_2_p_6" value="e_2_p_6_5" /> <label for="p_6_5">5</label>
        </div>
    </div>
</body>

</html>