<?php require view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Historial de Cursos</h1>
    <?php if ($isDocenteAndInstructor): ?>
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-4 btn-group py-4" name="rol" role="group">
                <input type="radio" class="btn-check" name="rol" id="rol-docente" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="rol-docente">Docente</label>
                <input type="radio" class="btn-check" name="rol" id="rol-instructor" autocomplete="off">
                <label class="btn btn-outline-primary" for="rol-instructor">Instructor</label>
            </div>
        </div>
        <div>
            <h2>Cursos sin evaluar</h2>
            <div>
                <?php if (!empty($cursosNoEvaluados)): ?>
                    <?php foreach ($cursosNoEvaluados as $curso): ?>
                        <p>Nombre del curso: <?= $curso["CURSO_Nombre"]; ?></p>
                        <form action="/historial/evaluarCurso" method="POST">
                            <input type="hidden" name="CURSOID" value="<?= $curso["CURSOID"] ?>">
                            <button type="submit" class="btn btn-primary">Evaluar curso</button>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay cursos por evaluar.</p>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <h2>Encuesta de eficacia</h2>
            <div>
                <?php if (!empty($cursosSinSegundaEncuesta)): ?>
                    <?php foreach ($cursosSinSegundaEncuesta as $curso): ?>
                        <p>Nombre del curso: <?= $curso["CURSO_Nombre"]; ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay cursos por evaluar.</p>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <h2>Cursos concluidos</h2>
            <div>
                <?php if (!empty($cursosConcluidos)): ?>
                    <?php foreach ($cursosConcluidos as $curso): ?>
                        <p>Nombre del curso: <?= $curso["CURSO_Nombre"]; ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay cursos concluidos.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif ?>
</main>
<?php require view("components/styledFooter.php"); ?>