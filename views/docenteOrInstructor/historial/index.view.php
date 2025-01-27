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
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?= count($cursosNoEvaluados) > 0 ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#cursos-sin-evaluar" aria-expanded="false" aria-controls="cursos-sin-evaluar">
                    <div class="w-100 row align-items-center justify-content-between">
                        <span class="col fs-4">Cursos sin Evaluar</span>
                        <span class="col text-end me-3"><?= count($cursosNoEvaluados) ?></span>
                    </div>
                </button>
            </h2>
            <div id="cursos-sin-evaluar" class="accordion-collapse collapse <?= count($cursosNoEvaluados) > 0 ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($cursosNoEvaluados)): ?>
                        <?php foreach ($cursosNoEvaluados as $key => $curso): ?>
                            <div class="row align-items-center justify-content-between gap-3">
                                <span class="col-12 col-md-auto"><?= $curso["CURSO_Nombre"]; ?></span>
                                <form class="d-grid col-12 col-md-auto" action="/historial/evaluarCurso" method="GET">
                                    <input type="hidden" name="CURSOID" value="<?= $curso["CURSOID"] ?>">
                                    <button type="submit" class="btn btn-outline-primary">Evaluar curso</button>
                                </form>
                            </div>
                            <?php if ($key < count($cursosNoEvaluados) - 1): ?>
                                <hr class="text-body-tertiary" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-secondary">No hay cursos por evaluar.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?= count($cursosSinSegundaEncuesta) > 0 ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="w-100 row align-items-center justify-content-between">
                        <span class="col fs-4">Encuesta de Eficacia</span>
                        <span class="col text-end me-3"><?= count($cursosSinSegundaEncuesta) ?></span>
                    </div>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse <?= count($cursosSinSegundaEncuesta) > 0 ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($cursosSinSegundaEncuesta)): ?>
                        <?php foreach ($cursosSinSegundaEncuesta as $key => $curso): ?>
                            <div class="row align-items-center justify-content-between gap-3">
                                <span class="col-12 col-md-auto"><?= $curso["CURSO_Nombre"]; ?></span>
                                <form class="d-grid col-12 col-md-auto" action="/historial/evaluarEficacia" method="GET">
                                    <input type="hidden" name="CURSOID" value="<?= $curso["CURSOID"] ?>">
                                    <button type="submit" class="btn btn-outline-primary">Evaluar curso</button>
                                </form>
                            </div>
                            <?php if ($key < count($cursosSinSegundaEncuesta) - 1): ?>
                                <hr class="text-body-tertiary" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-secondary">No hay cursos por evaluar.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </div>
</main>
<?php view("components/styledFooter.php"); ?>