<?php view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="d-flex flex-column align-items-start gap-2 pb-4">
        <h1><span class="fw-light"><?= $title ?></span> <span><?= $courseName["CURSO_Nombre"] ?></span></h1>
        <span class="badge rounded-pill text-bg-primary"><span class="fw-normal"><?= $instructorNombre ?></span></span>
    </div>
    <span>Por favor, responda el siguiente cuestionario de la manera más objetiva. Coloque un número del 1 al 5 considerando
        que uno es muy malo y 5 excelente, anote el que mejor describa su percepción del evento.</span>
    <div class="pt-4">
        <form action="/historial/evaluarCurso/F04PSA19" method="POST">
            <input type="hidden" name="CURSOID" value="<?= $_POST["CURSOID"] ?>">
            <div class="d-flex flex-column gap-3">
                <?php
                $mostrarSubtituloInstructor = true;
                $mostrarSubtituloOrganizacion = true;
                foreach ($questions as $row):
                    $questionID = htmlspecialchars($row["PREGUNTAID"], ENT_QUOTES, "UTF-8");
                    $questionText = htmlspecialchars($row["PREGUNTA_Texto"], ENT_QUOTES, "UTF-8");
                    $options = range(1, 5);

                    // Mostrar subtítulo de evaluación del instructor
                    if ($mostrarSubtituloInstructor && strpos($questionText, $preguntaInstructor) !== false) {
                        echo "<h4 class='fs-2'>Evaluación de instructor</h4>";
                        $mostrarSubtituloInstructor = false; // Evita mostrar el subtítulo más de una vez
                    }

                    // Mostrar subtítulo de evaluación de organización y logística
                    if ($mostrarSubtituloOrganizacion && strpos($questionText, $preguntaOrganizacion) !== false) {
                        echo "<h4 class='fs-2'>Evaluación de organización y logística</h4>";
                        $mostrarSubtituloOrganizacion = false; // Evita mostrar el subtítulo más de una vez
                    }
                ?>
                    <div class="row g-2 align-items-start">
                        <label for="<?= $questionID ?>" class="col-12 col-md-8"><?= $questionText ?></label>
                        <div class="btn-group col-12 col-md-4" role="group">
                            <?php foreach ($options as $op): ?>
                                <input type="radio" class="btn-check" required name="<?= $questionID ?>" id="<?= $op ?>-<?= $questionID ?>" value="<?= $op ?>">
                                <label class="btn btn-outline-primary" for="<?= $op ?>-<?= $questionID ?>"><?= $op ?></label>
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
<?php view("components/styledFooter.php"); ?>