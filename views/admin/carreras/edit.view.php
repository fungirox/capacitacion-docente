<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <div class="row row-cols-auto align-items-center">
        <a href="/admin/carreras"><i class="col bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col"><?= $title ?></h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/carreras">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= cleanOld("id", $career["CARRERAID"]) ?>">
        <div class="col-md-8">
            <label for="nombre" class="form-label">Nombre de la carrera</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre", $career["CARRERA_Nombre"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label for="siglas" class="form-label">Siglas</label>
            <input type="text" class="form-control <?= isValidInput($errors, "siglas") ?>" id="siglas" name="siglas" value="<?= cleanOld("siglas", $career["CARRERA_Siglas"]) ?>">
            <div class="form-text">Usualmente de 3 a 4 letras.</div>
            <div class="invalid-feedback">
                <?= $errors['siglas'] ?>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-end pt-4 g-2">
            <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                <a href="/admin/carreras" class="btn btn-outline-secondary">Cancelar</a>
            </div>
            <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>