<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="accordion mt-4">
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
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                <div class="mb-2 mb-md-0">
                                    <p class="mb-0 fs-5"><?= $curso["CURSO_Nombre"]; ?></p>
                                    <p class="mb-0 fs-6 text-secondary"><?= $curso["instructor"]; ?></p>
                                </div>
                                <form action="/historial/evaluarCurso" method="GET">
                                    <input type="hidden" name="CURSOID" value="<?= $curso["CURSOID"] ?>">
                                    <div class="d-grid"><button type="submit" class="btn btn-outline-primary">Evaluar curso</button></div>
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
                <button class="accordion-button <?= count($cursosSinEficacia) > 0 ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="w-100 row align-items-center justify-content-between">
                        <span class="col fs-4">Encuesta de Eficacia</span>
                        <span class="col text-end me-3"><?= count($cursosSinEficacia) ?></span>
                    </div>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse <?= count($cursosSinEficacia) > 0 ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($cursosSinEficacia)): ?>
                        <?php foreach ($cursosSinEficacia as $key => $curso): ?>
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                <div class="mb-2 mb-md-0">
                                    <p class="mb-0 fs-5"><?= $curso["CURSO_Nombre"]; ?></p>
                                    <p class="mb-0 fs-6 text-secondary"><?= formatPeriod($curso["instructor"]); ?></p>
                                </div>
                                <form action="/historial/evaluarEficacia" method="GET">
                                    <input type="hidden" name="CURSOID" value="<?= $curso["CURSOID"] ?>">
                                    <div class="d-grid"><button type="submit" class="btn btn-outline-primary">Evaluar curso</button></div>
                                </form>
                            </div>
                            <?php if ($key < count($cursosSinEficacia) - 1): ?>
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