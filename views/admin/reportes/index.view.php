<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1 class="mb-4"><?= $title ?></h1>
    <h2 class="mb-3">Cursos sin Eficacia</h2>
    <div class="row gap-4 mb-4">
        <?php if (!empty($cursosSinEficacia)): ?>
            <?php foreach ($cursosSinEficacia as $key => $curso): ?>
                <div class="col-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <h4 class="mb-3"><?= $curso["CURSO_Nombre"]; ?></h4>
                            <div class="row">
                                <div class="col d-grid">
                                    <a href="/admin/resumenEvaluacion?id=<?= $curso["CURSOID"] ?>" class="btn btn-outline-primary">
                                        Resumen encuesta evaluacion
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <div class="alert alert-light" role="alert">
                    No hay cursos evaluados.
                </div>
            </div>
        <?php endif; ?>
    </div>
    <h2 class="mb-3">Cursos concluidos</h2>
    <div class="row gap-4">
        <?php if (!empty($cursosConcluidos)): ?>
            <?php foreach ($cursosConcluidos as $key => $curso): ?>
                <div class="col-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <h4 class="mb-3"><?= $curso["CURSO_Nombre"]; ?></h4>
                            <div class="row gap-2">
                                <div class="col-12 col-md d-grid">
                                    <a href="/admin/resumenEvaluacion?id=<?= $curso["CURSOID"] ?>" class="btn btn-outline-primary">
                                        Resumen encuesta evaluacion
                                    </a>
                                </div>
                                <!-- pendiente -->
                                <div class="col-12 col-md d-grid">
                                    <a href="/admin/resumenEficacia?id=<?= $curso["CURSOID"] ?>" class="btn btn-outline-primary">
                                        Resumen encuesta eficacia
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <div class="alert alert-light" role="alert">
                    No hay cursos concluidos.
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>