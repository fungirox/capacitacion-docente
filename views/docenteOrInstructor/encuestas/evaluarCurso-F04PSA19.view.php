<?php require view("components/styledHeader.php"); ?>

<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Evaluar curso</h1>
    <h2><?= $courseName["CURSO_Nombre"] ?></h2>
    <p><?= $instructorName["USER_Nombre"]?> <?= $instructorName["USER_Apellido"]?></p>  
    <p>Por favor, responda el siguiente cuestionario de la manera más objetiva. Coloque un número del 1 al 5 considerando
    que uno es muy malo y 5 excelente, anote el que mejor describa su percepción del evento.</p>
    <div>
        <form action="/historial/evaluarCurso/F04PSA19" method="POST">
            <input type="hidden" name="CURSOID" value="<?= $_POST["CURSOID"] ?>">
            <div>
                <?php
                $mostrarSubtituloInstructor = true;
                $mostrarSubtituloOrganizacion = true;
                foreach ($questions as $row):
                    $questionID = htmlspecialchars($row["PREGUNTAID"], ENT_QUOTES, "UTF-8");
                    $questionText = htmlspecialchars($row["PREGUNTA_Texto"], ENT_QUOTES, "UTF-8");
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
    </div>  
</main>
<?php require view("components/styledFooter.php"); ?>