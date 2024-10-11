<?php require view("components/styledHeader.php"); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="row row-cols-auto align-items-center">
        <a href="/admin/carreras"><i class="col bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col">Registrar Usuario Docente</h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/registro">
        <div class="col-md-6">
            <label for="nomina" class="form-label">Número de nómina</label>
            <input type="text" class="form-control <?= isset($errors['nomina']) ? 'is-invalid' : '' ?>" id="nomina" name="nomina" value="<?= isset($_POST['nomina']) ? htmlspecialchars($_POST['nomina']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['nomina'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="cip" class="form-label">CIP</label>
            <input type="password" class="form-control <?= isset($errors['cip']) ? 'is-invalid' : '' ?>" id="cip" name="cip" value="<?= isset($_POST['cip']) ? htmlspecialchars($_POST['cip']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['cip'] ?>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-end pt-4 g-2">
            <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                <a href="/admin/carreras" class="btn btn-outline-secondary">Cancelar</a>
            </div>
            <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </form>
</main>
<?php require view("components/styledFooter.php"); ?>