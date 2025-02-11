<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/admin/personal", "title" => $title]) ?>
    <form class="row mt-4" method="POST" action="/admin/personal">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= cleanOld("id", $personal["id"]) ?>">
        <div class="col-12 mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre", $personal["nombre"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="puesto" class="form-label">Puesto</label>
            <input type="text" class="form-control <?= isValidInput($errors, "puesto") ?>" id="puesto" name="puesto" value="<?= cleanOld("puesto", $personal["puesto"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['puesto'] ?>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <label for="titulo" class="form-label">Título</label>
            <select class="form-select <?= isValidInput($errors, "titulo") ?>" id="titulo" name="titulo">
                <?php foreach ($titulos as $key => $titulo): ?>
                    <option value="<?= $key ?>" <?= cleanOld("titulo", $personal["titulo"]) === $key ? "selected" : "" ?>><?= $titulo ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $errors['titulo'] ?>
            </div>
        </div>
        <div class="order-2 order-md-1 col-md-auto col-12 ms-md-auto mb-3">
            <div class="d-grid"><a href="/admin/personal" class="btn btn-outline-secondary">Cancelar</a></div>
        </div>
        <div class="order-1 order-md-2 col-md-auto col-12 mb-3">
            <div class="d-grid"><button type="submit" class="btn btn-primary">Guardar</button></div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>