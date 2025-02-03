<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/admin/instructores", "title" => $title]) ?>
    <form class="row mt-4" method="POST" action="/admin/instructores">
        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre") ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-control <?= isValidInput($errors, "apellido") ?>" id="apellido" name="apellido" value="<?= cleanOld("apellido") ?>">
            <div class="invalid-feedback">
                <?= $errors['apellido'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control <?= isValidInput($errors, "username") ?>" id="username" name="username" value="<?= cleanOld("username") ?>">
            <div class="form-text">Se utilizará para iniciar sesión.</div>
            <div class="invalid-feedback">
                <?= $errors['username'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control <?= isValidInput($errors, "email") ?>" id="email" name="email" value="<?= cleanOld("email") ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select <?= isValidInput($errors, "genero") ?>" id="genero" name="genero">
                <option value="0" <?= cleanOld("genero", "0") === "0" ? "selected" : "" ?>>Masculino</option>
                <option value="1" <?= cleanOld("genero") === "1" ? "selected" : "" ?>>Femenino</option>
            </select>
            <div class="invalid-feedback">
                <?= $errors['genero'] ?>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="estudios" class="form-label">Nivel de estudios</label>
            <select class="form-select <?= isValidInput($errors, "estudios") ?>" id="estudios" name="estudios">
                <?php foreach ($nivelEstudios as $key => $value) : ?>
                    <option value="<?= $key ?>" <?= cleanOld("estudios", "maestria") === $key ? "selected" : "" ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $errors['estudios'] ?>
            </div>
        </div>
        <div class="col-6 mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control <?= isValidInput($errors, "password") ?>" id="password" name="password">
            <div class="invalid-feedback">
                <?= $errors['password'] ?>
            </div>
        </div>
        <div class="col-6 mb-4">
            <label for="confirm-password" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control <?= isValidInput($errors, "confirmPassword") ?>" id="confirm-password" name="confirm-password">
            <div class="invalid-feedback">
                <?= $errors['confirmPassword'] ?>
            </div>
        </div>
        <div class="order-2 order-md-1 col-md-auto col-12 ms-md-auto mb-3">
            <div class="d-grid"><a href="/admin/instructores" class="btn btn-outline-secondary">Cancelar</a></div>
        </div>
        <div class="order-1 order-md-2 col-md-auto col-12 mb-3">
            <div class="d-grid"><button type="submit" class="btn btn-primary">Agregar</button></div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>