<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(() => {
        const handleRoleVisibility = () => {
            const rolValue = $('input[name="rol"]').val().toLowerCase();
            const isDocente = rolValue === 'docente';
            const isDocenteAndInstructor = rolValue === 'docenteandinstructor';

            if (isDocente || isDocenteAndInstructor) {
                $('#hora-base-check-container').show();
                $('#horas-base-container').show();
            } else {
                $('#hora-base-check-container').hide();
                $('#horas-base-container').hide();
            }

            if (isDocente) {
                $('#docente-instructor-switch').show();
            } else {
                $('#docente-instructor-switch').hide();
            }
        }

        handleRoleVisibility();

        $('input[name="rol"]').on('input', handleRoleVisibility);
    });
</script>
<main role="main" class="container py-4" style="margin-top: 56px">
    <div class="row row-cols-auto align-items-center">
        <a href="/admin/usuarios"><i class="col bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col"><?= $title ?></h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/usuarios">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= cleanOld("id", $usuario["USERID"]) ?>">
        <input type="hidden" name="rol" value="<?= cleanOld("rol", $usuario["rol"]) ?>">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre", $usuario["USER_Nombre"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control <?= isValidInput($errors, "apellido") ?>" id="apellido" name="apellido" value="<?= cleanOld("apellido", $usuario["USER_Apellido"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['apellido'] ?>
            </div>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isValidInput($errors, "email") ?>" id="email" name="email" value="<?= cleanOld("email", $usuario["USER_Email"]) ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        </div>
        <!-- <div class="col-md-6">
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
        </div> -->
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