<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <div class="row align-items-center">
        <a class="col-12 col-md-auto" href="/admin/areas"><i class="bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col-12 col-md-10"><?= $title ?></h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/areas">
        <div class="col-md-8">
            <label for="nombre" class="form-label">Nombre de la área</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre") ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label for="siglas" class="form-label">Siglas</label>
            <input type="text" class="form-control <?= isValidInput($errors, "siglas") ?>" id="siglas" name="siglas" value="<?= cleanOld("siglas") ?>">
            <div class="form-text">Usualmente de 3 a 4 letras.</div>
            <div class="invalid-feedback">
                <?= $errors['siglas'] ?>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-end pt-4 g-2">
            <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                <a href="/admin/areas" class="btn btn-outline-secondary">Cancelar</a>
            </div>
            <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>