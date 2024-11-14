<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$title = "Evaluar curso";

# Esta query no es la definitiva es temporal mientras hacemos un login con todos los users y roles
$teachersQuery = "SELECT u.USERID, u.USER_Nombre, u.USER_Apellido FROM tblUsuario u JOIN tblUsuarioRoles ur ON u.USERID = ur.USERID JOIN tblRol r ON ur.ROLID = r.ROLID WHERE r.ROL_Nombre = 'Docente'";

# Aquí necesitamos el id del curso que elegimos desde la interfaz de "historial" por ahora dejaré cursoid = 1
$questionsQuery = "SELECT * FROM tblPregunta where ENCUESTAID = '1';";

$teachersData = $db->query($teachersQuery)->getAll();

$questions = $db->query($questionsQuery)->getAll();

$curso_name = "Taller de construcción para principantes en Fortnite: Battle Royale";
$instructor_name = "José Diego Rascón Amador";

require view("components/styledHeader.php");

?>

<!DOCTYPE html>
<html lang="en">
<main role="main" class="container py-4" style="margin-top: 56px">

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
            <p class="fs-5">Por <span class="fw-bold"><?php echo $instructor_name ?></span></p>
        </div>
        <p class="fs-5 pt-4">Por favor, responda el siguiente cuestionario de la manera más objetiva. Seleccione un número del 1 al 5 considerando que: 1 es muy malo y 5 excelente, elija el que mejor describa su percepción del evento.</p>
        <form action="../modules/F04PSA19.php" method="post">
            <div class="pb-3">
                <!--- Seleccionar docente al que se le registra dicha respuesta, esto es temporal mientras hay un login --->
                <label for="teachers" class="fs-5 mb-2">Seleccione el docente:</label>
                <select class="form-select" type="button" name="teachers" id="teachers">
                    <?php foreach ($teachersData as $row) : ?>
                        <?php
                        $userID = htmlspecialchars($row['USERID'], ENT_QUOTES, 'UTF-8');
                        $userFirstName = htmlspecialchars($row['USER_Nombre'], ENT_QUOTES, 'UTF-8');
                        $userLastName = htmlspecialchars($row['USER_Apellido'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <option class="dropdown-item" value="<?= $userID ?>"><?= $userFirstName ?> <?= $userLastName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
            // Esta es la pregunta clave que inicia la evaluación del instructor
            $preguntaInstructor = "La o el instructor inició en los primeros 10 minutos";

            // Esta es la pregunta clave que inicia la evaluación de la organización
            $preguntaOrganizacion = "La organización del evento fue";
            ?>

            <div>
                <?php
                $mostrarSubtituloInstructor = true;
                $mostrarSubtituloOrganizacion = true;
                foreach ($questions as $row):
                    $questionID = htmlspecialchars($row['PREGUNTAID'], ENT_QUOTES, 'UTF-8');
                    $questionText = htmlspecialchars($row['PREGUNTA_Texto'], ENT_QUOTES, 'UTF-8');
                    $options = range(1, 5);

                    // Mostrar subtítulo de evaluación del instructor
                    if ($mostrarSubtituloInstructor && strpos($questionText, $preguntaInstructor) !== false) {
                        echo "<h4 class='py-3 fs-2'>Evaluación de instructor</h4>";
                        $mostrarSubtituloInstructor = false; // Evita mostrar el subtítulo más de una vez
                    }

                    // Mostrar subtítulo de evaluación de organización y logística
                    if ($mostrarSubtituloOrganizacion && strpos($questionText, $preguntaOrganizacion) !== false) {
                        echo "<h4 class='py-3 fs-2'>Evaluación de organización y logística</h4>";
                        $mostrarSubtituloOrganizacion = false; // Evita mostrar el subtítulo más de una vez
                    }
                ?>
                    <div class="fs-5 d-flex justify-content-between align-items-center mb-3">
                        <label for="<?= $questionID ?>" class="flex-grow-1 mb-0"><?= $questionText ?></label>
                        <div class="d-flex">
                            <?php foreach ($options as $op): ?>
                                <div class="form-check ms-3">
                                    <input type="radio" class="form-check-input" required name="<?= $questionID ?>" id="<?= $op ?>-<?= $questionID ?>" value="<?= $op ?>">
                                    <label class="form-check-label" for="<?= $op ?>-<?= $questionID ?>"><?= $op ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Queda pendiente el comentarios (textarea) -->
            <!-- Queda pendiente frontend y separar por categorias las preguntas :D -->
            <div class="pt-4 d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary btn-lg fs-5" type="submit">Evaluar</button>
            </div>
        </form>
    </body>
</main>

</html>