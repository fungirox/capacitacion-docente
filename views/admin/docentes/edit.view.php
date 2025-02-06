<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });

        const docenteBaseCheck = $('#base-check');
        const horasBaseInput = $('#horas-base-container');
        const docenteInstructorSwitch = $('#docente-instructor');
        const estudiosContainer = $('#estudios-container');

        function togglePasswordFields(show) {
            const passwordContainer = $('#password').closest('.col-6');
            const confirmContainer = $('#confirm-password').closest('.col-6');

            if (show) {
                passwordContainer.show();
                confirmContainer.show();
            } else {
                passwordContainer.hide();
                confirmContainer.hide();
                $('#password, #confirm-password').val('');
            }
        }

        const isChecked = $('#update-password').is(':checked');

        $('#update-password').on('change', function() {
            togglePasswordFields(this.checked);
        });

        function showHorasBaseInput() {
            if (docenteBaseCheck.prop('checked')) {
                horasBaseInput.show();
            } else {
                horasBaseInput.hide();
            }
        }

        function showEstudiosSelector() {
            if (docenteInstructorSwitch.prop('checked')) {
                estudiosContainer.show();
            } else {
                estudiosContainer.hide();
            }
        }

        $('input[name="base-horas"]').on('change', () => {
            showHorasBaseInput();
        })

        docenteInstructorSwitch.on('change', () => {
            showEstudiosSelector();
        });

        togglePasswordFields(isChecked);
        showHorasBaseInput();
        showEstudiosSelector();
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/admin/docentes", "title" => $title]) ?>
    <form class="row mt-4" method="POST" action="/admin/docentes">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $docente["id"] ?>">
        <input type="hidden" name="is-docente-instructor" value="<?= $docente["docenteInstructor"] ?>">
        <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre", $docente["nombre"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-control <?= isValidInput($errors, "apellido") ?>" id="apellido" name="apellido" value="<?= cleanOld("apellido", $docente["apellido"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['apellido'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="username" class="form-label">Nómina</label>
            <input type="number" class="form-control <?= isValidInput($errors, "username") ?>" id="username" name="username" value="<?= cleanOld("username", $docente["username"]) ?>">
            <div class="form-text">Se utilizará para iniciar sesión.</div>
            <div class="invalid-feedback">
                <?= $errors['username'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control <?= isValidInput($errors, "email") ?>" id="email" name="email" value="<?= cleanOld("email", $docente["email"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select <?= isValidInput($errors, "genero") ?>" id="genero" name="genero">
                <option value="0" <?= cleanOld("genero", $docente["genero"]) === "0" ? "selected" : "" ?>>Masculino</option>
                <option value="1" <?= cleanOld("genero", $docente["genero"]) === "1" ? "selected" : "" ?>>Femenino</option>
            </select>
            <div class="invalid-feedback">
                <?= $errors['genero'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" <?= cleanOld("updatePassword") === "1" ? "checked" : "" ?> type="checkbox" role="switch" name="update-password" id="update-password">
                <label class="form-check-label" for="update-password">Cambiar contraseña</label>
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
        <div id="hora-base-check-container" class="col-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="base-horas" id="base-check" value="1" <?= cleanOld("baseHoras", $docente["baseHoras"]) === "1" ? "checked" : "" ?>>
                <label class="form-check-label" for="base-check">
                    Docente de base
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="base-horas" id="horas-check" value="0" <?= cleanOld("baseHoras", $docente["baseHoras"]) === "0" ? "checked" : "" ?>>
                <label class="form-check-label" for="horas-check">
                    Docente por horas
                </label>
            </div>
        </div>
        <div id="horas-base-container" class="col-12 mb-3">
            <label for="horas-base" class="form-label">Horas base</label>
            <input type="number" min=0 class="form-control <?= isValidInput($errors, "horasBase") ?>" id="horas-base" name="horas-base" value="<?= cleanOld("horasBase", $docente["horasBase"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['horasBase'] ?>
            </div>
        </div>
        <div id="docente-instructor-switch" class="col-12 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" role="switch" name="docente-instructor" id="docente-instructor" value="1" <?= cleanOld("docenteInstructor", $docente["docenteInstructor"]) === "1" ? "checked" : "" ?> <?= $docente["docenteInstructor"] === "1" ? "disabled" : "" ?>>
                <label class="form-check-label" for="docente-instructor">El docente es instructor</label>
            </div>
        </div>
        <div id="estudios-container" class="col-12 mb-3">
            <label for="estudios" class="form-label">Nivel de estudios</label>
            <select class="form-select <?= isValidInput($errors, "estudios") ?>" id="estudios" name="estudios">
                <?php foreach ($nivelEstudios as $key => $value) : ?>
                    <option value="<?= $key ?>" <?= cleanOld("estudios", $docente["estudios"]) === $key ? "selected" : "" ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $errors['estudios'] ?>
            </div>
        </div>
        <div class="order-2 order-md-1 col-md-auto col-12 ms-md-auto mb-3">
            <div class="d-grid"><a href="/admin/docentes" class="btn btn-outline-secondary">Cancelar</a></div>
        </div>
        <div class="order-1 order-md-2 col-md-auto col-12 mb-3">
            <div class="d-grid"><button type="submit" class="btn btn-primary">Guardar</button></div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>