<?php view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="d-flex flex-column align-items-start gap-2 pb-4">
        <div class="row align-items-center">
            <a class="col-12 col-md-auto" href="/historial"><i class="bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
            <h1 class="col-12 col-md-10"><span class="fw-light"><?= $title ?></span> <span><?= $cursoNombre ?></span></h1>
        </div>
        <span class="badge rounded-pill text-bg-primary"><span class="fw-normal"><?= $instructorNombre ?></span></span>
    </div>
    <span>Por favor, responda el siguiente cuestionario de la manera más objetiva. Coloque un número del 1 al 5 considerando
        que uno es muy malo y 5 excelente, anote el que mejor describa su percepción del evento.</span>
    <div class="pt-4">
        <form action="/evaluaciones/evaluarServicio" method="POST">
            <input type="hidden" name="CURSOID" value="<?= $cursoId ?>">
            <input type="hidden" name="ENCUESTAID" value="2">
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