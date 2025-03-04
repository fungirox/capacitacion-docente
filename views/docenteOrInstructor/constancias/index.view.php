<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="accordion mt-4" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocente" aria-expanded="false" aria-controls="collapseDocente">
                    <div class="w-100 row align-items-center justify-content-between">
                        <span class="col fs-4">Como Docente</span>
                        <span class="col text-end me-3"><?= count($constanciasDocente) ?></span>
                    </div>
                </button>
            </h2>
            <div id="collapseDocente" class="accordion-collapse collapse <?= !empty($constanciasDocente) ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($constanciasDocente)): ?>
                        <?php foreach ($constanciasDocente as $key => $curso): ?>
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                <div class="mb-2 mb-md-0">
                                    <p class="mb-0 fs-5"><?= $curso["CURSO_Nombre"]; ?></p>
                                    <p class="mb-0 fs-6 text-secondary"><?= formatPeriod($curso["CONSTANCIA_Folio"]); ?></p>
                                </div>
                                <form action="/historial/constancia" method="GET">
                                    <input type="hidden" name="id" value="<?= $curso["CONSTANCIAID"] ?>">
                                    <div class="d-grid"><button type="submit" class="btn btn-outline-primary">Descargar constancia</button></div>
                                </form>
                            </div>
                            <?php if ($key < count($constanciasDocente) - 1): ?>
                                <hr class="text-body-tertiary" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-secondary">No hay constancias como docente.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInstructor" aria-expanded="false" aria-controls="collapseInstructor">
                    <div class="w-100 row align-items-center justify-content-between">
                        <span class="col fs-4">Como Instructor</span>
                        <span class="col text-end me-3"><?= count($constanciasInstructor) ?></span>
                    </div>
                </button>
            </h2>
            <div id="collapseInstructor" class="accordion-collapse collapse <?= !empty($constanciasInstructor) ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($constanciasInstructor)): ?>
                        <?php foreach ($constanciasInstructor as $key => $curso): ?>
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                <div class="mb-2 mb-md-0">
                                    <p class="mb-0 fs-5"><?= $curso["CURSO_Nombre"]; ?></p>
                                    <p class="mb-0 fs-6 text-secondary"><?= formatPeriod($curso["CONSTANCIA_Folio"]); ?></p>
                                </div>
                                <form action="/historial/constancia" method="GET">
                                    <input type="hidden" name="id" value="<?= $curso["CONSTANCIAID"] ?>">
                                    <div class="d-grid"><button type="submit" class="btn btn-outline-primary">Descargar constancia</button></div>
                                </form>
                            </div>
                            <?php if ($key < count($constanciasInstructor) - 1): ?>
                                <hr class="text-body-tertiary" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-secondary">No hay constancias como instructor.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>