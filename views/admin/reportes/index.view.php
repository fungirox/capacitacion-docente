<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="">
        <?php if (!empty($cursosSinEficacia)): ?>
            <?php foreach ($cursosSinEficacia as $key => $curso): ?>
                <div class="">
                    <span class="col-12 col-md-auto"><?= $curso["CURSO_Nombre"]; ?></span>
                    <div>
                    <a href="/admin/resumenEvaluacion?id=<?= $curso["CURSOID"]?>">Resumen encuesta evaluacion</a>
                </div>

                </div>
                
            <?php endforeach; ?> 
        <?php else: ?>
            <span class="text-secondary">No hay cursos evaluados.</span>
        <?php endif; ?>
    </div>

    <div class="">
        <?php if (!empty($cursosConcluidos)): ?>
            <?php foreach ($cursosConcluidos as $key => $curso): ?>
                <div><?= $curso["CURSO_Nombre"]; ?></div>
                <div>
                    <a href="/admin/resumenEvaluacion?id=<?= $curso["CURSOID"]?>">Resumen encuesta evaluacion</a>
            <!-- pendiente -->
                    <a href="/admin/resumenEficacia?id=<?= $curso["CURSOID"]?>">Resumen encuesta eficacia</a> 
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="text-secondary">No hay cursos concluidos.</span>
        <?php endif; ?>
    </div>


</main>
<?php view("components/styledFooter.php"); ?>