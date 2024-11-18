<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        const rolDocente = $('#rol-docente');
        const rolInstructor = $('#rol-instructor');
        const rolAdministrador = $('#rol-administrador');
        const adminWarning = $('#admin-warning');
        const usernameLabel = $('label[for="username"]');
        const instructorSwitch = $('#docente-instructor-switch');
        const docenteBaseCheckContainer = $('#hora-base-check-container');
        const docenteBaseCheck = $('#base-check');
        const horasBaseInput = $('#horas-base-container');

        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });

        const toggleAdminWarning = () => {
            if (rolAdministrador.prop('checked')) {
                adminWarning.show();
            } else {
                adminWarning.hide();
            }
        }

        const updateUsernameLabel = () => {
            if (rolDocente.prop('checked')) {
                usernameLabel.text('Nómina');
                instructorSwitch.show();
                docenteBaseCheckContainer.show();
                horasBaseInput.show();
            } else {
                usernameLabel.text('Nombre de usuario')
                instructorSwitch.hide();
                docenteBaseCheckContainer.hide();
                horasBaseInput.hide();
            }
        }

        const showHorasBaseInput = () => {
            if (docenteBaseCheck.prop('checked')) {
                horasBaseInput.show();
            } else {
                horasBaseInput.hide();
            }
        }

        $('input[name="rol"]').on('change', () => {
            toggleAdminWarning();
            updateUsernameLabel();
        });

        $('input[name="base-horas"]').on('change', () => {
            showHorasBaseInput();
        })

        toggleAdminWarning();
        updateUsernameLabel();
        showHorasBaseInput();
    });
</script>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="row row-cols-auto align-items-center">
        <a href="/admin/usuarios"><i class="col bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col"><?= $title ?></h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/usuarios">
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 btn-group pb-4" name="rol" role="group">
                <input type="radio" class="btn-check" name="rol" id="rol-docente" value="docente" autocomplete="off" <?= cleanOld("rol", "docente") === "docente" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="rol-docente">Docente</label>
                <input type="radio" class="btn-check" name="rol" id="rol-instructor" value="instructor" autocomplete="off" <?= cleanOld("rol") === "instructor" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="rol-instructor">Instructor Externo</label>
                <input type="radio" class="btn-check" name="rol" id="rol-administrador" value="administrador" autocomplete="off" <?= cleanOld("rol") === "administrador" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="rol-administrador">Administrador</label>
            </div>
        </div>
        <div id="admin-warning">
            <div class="alert alert-danger" role="alert">
                <strong>Precaución</strong>, al agregar un usuario administrador, este tendrá acceso a toda la información del sistema y será capáz de agregar a más usuarios.
            </div>
        </div>
        <div class="col-md-6">
            <label for="username" class="form-label">Nómbre de usuario</label>
            <input type="text" class="form-control <?= isValidInput($errors, "username") ?>" id="username" name="username" value="<?= cleanOld("username") ?>">
            <div class="invalid-feedback">
                <?= $errors['username'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select <?= isValidInput($errors, "genero") ?>" id="genero" name="genero">
                <option value="0" <?= cleanOld("genero", "0") === "0" ? "selected" : "" ?>>Masculino</option>
                <option value="1" <?= cleanOld("genero") === "1" ? "selected" : "" ?>>Femenino</option>
            </select>
            <div class="invalid-feedback">
                <?= $errors['genero'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre") ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control <?= isValidInput($errors, "apellido") ?>" id="apellido" name="apellido" value="<?= cleanOld("apellido") ?>">
            <div class="invalid-feedback">
                <?= $errors['apellido'] ?>
            </div>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isValidInput($errors, "email") ?>" id="email" name="email" value="<?= cleanOld("email") ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control <?= isValidInput($errors, "contraseña") ?>" id="contraseña" name="contraseña" value="">
            <div class="invalid-feedback">
                <?= $errors['contraseña'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="confirmar-contraseña" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control <?= isValidInput($errors, "confirmarContraseña") ?>" id="confirmar-contraseña" name="confirmar-contraseña" value="">
            <div class="invalid-feedback">
                <?= $errors['confirmarContraseña'] ?>
            </div>
        </div>
        <div id="hora-base-check-container">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="base-horas" id="base-check" value="1" <?= cleanOld("base-horas", "1") === "1" ? "checked" : "" ?>>
                <label class="form-check-label" for="base-check">
                    Docente de base
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="base-horas" id="horas-check" value="0" <?= cleanOld("base-horas") === "0" ? "checked" : "" ?>>
                <label class="form-check-label" for="horas-check">
                    Docente por horas
                </label>
            </div>
        </div>
        <div class="col-md-12" id="horas-base-container">
            <label for="horas-base" class="form-label">Horas base</label>
            <input type="number" min=0 class="form-control <?= isValidInput($errors, "horas-base") ?>" id="horas-base" name="horas-base" value="<?= cleanOld("horas-base") ?>">
            <div class="invalid-feedback">
                <?= $errors['horas-base'] ?>
            </div>
        </div>
        <div id="docente-instructor-switch">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" role="switch" name="docente-instructor" id="docente-instructor" value="1" <?= cleanOld("docente-instructor", "0") === "1" ? "checked" : "" ?>>
                <label class="form-check-label" for="docente-instructor">El docente es instructor</label>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-end pt-4 g-2">
            <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                <a href="/admin/usuarios" class="btn btn-outline-secondary">Cancelar</a>
            </div>
            <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>