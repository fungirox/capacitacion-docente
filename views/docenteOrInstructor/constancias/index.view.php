<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <?php if ($isDocenteAndInstructor): ?>
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-4 btn-group py-4" name="rol" role="group">
                <input type="radio" class="btn-check" name="rol" id="rol-docente" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="rol-docente">Docente</label>
                <input type="radio" class="btn-check" name="rol" id="rol-instructor" autocomplete="off">
                <label class="btn btn-outline-primary" for="rol-instructor">Instructor</label>
            </div>
        </div>
    <?php endif ?>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button <?= count($constanciasDocente) > 0 ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <div class="w-100 row align-items-center justify-content-between">
                    <span class="col fs-4">Cursos Concluidos</span>
                    <span class="col text-end me-3"><?= count($constanciasDocente) ?></span>
                </div>
            </button>
        </h2>
        <div class="accordion-body">
            <?php if (!empty($constanciasDocente)): ?>
                <?php foreach ($constanciasDocente as $key => $curso): ?>
                    <div><?= $curso["CURSO_Nombre"]; ?></div>
                    <form class="d-grid col-12 col-md-auto" action="/historial/constanciaDocente" method="GET">
                        <input type="hidden" name="id" value="<?= $curso["CONSTANCIAID"] ?>">
                        <button type="submit" class="btn btn-outline-primary">Descargar constancia</button>
                    </form>
                    <?php if ($key < count($constanciasDocente) - 1): ?>
                        <hr class="text-body-tertiary" />
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="text-secondary">No hay cursos concluidos.</span>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>