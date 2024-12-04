<?php view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="d-flex flex-column align-items-start gap-2 pb-4">
        <div class="row align-items-center">
            <a class="col-12 col-md-auto" href="/historial"><i class="bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
            <h1 class="col-12 col-md-10"><span class="fw-light"><?= $title ?></span> <span><?= $courseName ?></span></h1>
        </div>
        <span class="badge rounded-pill text-bg-primary"><span class="fw-normal"><?= $instructorNombre ?></span></span>
    </div>
    <span>Esta encuesta busca conocer la eficacia de los cursos de actualización y capacitación docente.
        Agradecemos que con sinceridad marque la respuesta que a su juicio corresponde a la
        afirmación realizada con base en la siguiente escala:</span>
    <div class="pt-4">
        <form action="/historial/evaluarCurso/F08PSA19.00" method="POST">
            <input type="hidden" name="CURSOID" value="<?= $courseId ?>">
            <input type="hidden" name="questions" value="<?= $questions ?>">
            <div class="d-flex flex-column gap-3">
                <?php
                    foreach ($questions as $row):
                        $questionID = htmlspecialchars($row["PREGUNTAID"], ENT_QUOTES, "UTF-8");
                        $questionText = htmlspecialchars($row["PREGUNTA_Texto"], ENT_QUOTES, "UTF-8");
                        $options = range(1, 5);
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
            <div class="pt-4">
                <h2>Comentarios</h2>
                <textarea class="form-control" id="comentarios" rows="2"></textarea>
            </div>
            <div class="row row-cols-auto justify-content-end pt-4 g-2">
                <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                    <a href="/historial" class="btn btn-outline-secondary">Cancelar</a>
                </div>
                <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                    <button type="submit" class="btn btn-primary">Evaluar</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>