<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledHeader.php"; ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Carreras</h1>
    <form class="row py-4 g-3" method="POST">
        <div class="col-md-8">
            <label for="nombre" class="form-label">Nombre de la carrera</label>
            <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label for="siglas" class="form-label">Siglas</label>
            <input type="text" class="form-control <?= isset($errors['siglas']) ? 'is-invalid' : '' ?>" id="siglas" name="siglas" value="<?= isset($_POST['siglas']) ? htmlspecialchars($_POST['siglas']) : '' ?>">
            <div class="form-text">Usualmente de 3 a 4 letras.</div>
            <div class="invalid-feedback">
                <?= $errors['siglas'] ?>
            </div>
        </div>
        <div class="col-12 col-md-auto d-grid">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </form>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledFooter.php"; ?>