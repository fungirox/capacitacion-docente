<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="accordion mt-4" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocente" aria-expanded="false" aria-controls="collapseDocente">
                    Como Docente
                </button>
            </h2>
            <div id="collapseDocente" class="accordion-collapse collapse <?= !empty($constanciasDocente) ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($constanciasDocente)): ?>
                        <?php foreach ($constanciasDocente as $key => $curso): ?>
                            <div class="mb-2"><?= $curso["CURSO_Nombre"]; ?></div>
                            <form class="d-grid col-12 col-md-auto" action="/historial/constancia" method="GET">
                                <input type="hidden" name="id" value="<?= $curso["CONSTANCIAID"] ?>">
                                <button type="submit" class="btn btn-outline-primary">Descargar constancia</button>
                            </form>
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
                    Como Instructor
                </button>
            </h2>
            <div id="collapseInstructor" class="accordion-collapse collapse <?= !empty($constanciasInstructor) ? "show" : "" ?>">
                <div class="accordion-body">
                    <?php if (!empty($constanciasInstructor)): ?>
                        <?php foreach ($constanciasInstructor as $key => $curso): ?>
                            <div class="mb-2"><?= $curso["CURSO_Nombre"]; ?></div>
                            <form class="d-grid col-12 col-md-auto" action="/historial/constancia" method="GET">
                                <input type="hidden" name="id" value="<?= $curso["CONSTANCIAID"] ?>">
                                <button type="submit" class="btn btn-outline-primary">Descargar constancia</button>
                            </form>
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