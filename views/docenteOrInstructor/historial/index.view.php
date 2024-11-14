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
    <?php endif ?>
</main>
<?php require view("components/styledFooter.php"); ?>