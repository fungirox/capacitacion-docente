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
        <a href="/admin/usuarios"><i class="col bi bi-arrow-left-circle" style="font-size: 1.5rem;"></i></a>
        <h1 class="col">Nuevo Usuario</h1>
    </div>
    <form class="row py-4 g-3" method="POST" action="/admin/usuarios">
        <div class="col-md-4">
            <label for="nomina" class="form-label">Nómina</label>
            <input type="text" class="form-control <?= isset($errors['nomina']) ? 'is-invalid' : '' ?>" id="nomina" name="nomina" value="<?= isset($_POST['nomina']) ? htmlspecialchars($_POST['nomina']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['nomina'] ?>
            </div>
        </div>
        <div class="col-md-8">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select <?= isset($errors['genero']) ? 'is-invalid' : '' ?>" id="genero" name="genero">
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
            </select>
            <div class="invalid-feedback">
                <?= $errors['genero'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" id="nombre" name="nombre" value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control <?= isset($errors['apellido']) ? 'is-invalid' : '' ?>" id="apellido" name="apellido" value="<?= isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['apellido'] ?>
            </div>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control <?= isset($errors['contraseña']) ? 'is-invalid' : '' ?>" id="contraseña" name="contraseña" value="<?= isset($_POST['contraseña']) ? htmlspecialchars($_POST['contraseña']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['contraseña'] ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="confirmarContraseña" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control <?= isset($errors['confirmarContraseña']) ? 'is-invalid' : '' ?>" id="confirmarContraseña" name="confirmarContraseña" value="<?= isset($_POST['confirmarContraseña']) ? htmlspecialchars($_POST['confirmarContraseña']) : '' ?>">
            <div class="invalid-feedback">
                <?= $errors['confirmarContraseña'] ?>
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
<?php require view("components/styledFooter.php"); ?>