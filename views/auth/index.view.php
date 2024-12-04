<?php view("components/header.php", ["title" => $title]); ?>
<main class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-5 col-lg-7 p-0 m-0 d-none d-md-block">
            <img
                src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg"
                alt="Image"
                class="img-fluid"
                style="object-fit: cover; height: 100vh; width: 100vw">
        </div>
        <div class="col-12 col-md-7 col-lg-5 d-flex p-5 flex-column justify-content-between bg-body-tertiary">
            <div class="d-flex flex-column gap-5">
                <div class="d-flex flex-column gap-4">
                    <img src="../../assets/images/icono-itesca-grande.png" alt="Logo de ITESA" style="align-self: center; object-fit: cover; width: 100px; padding-top: 15vh;">
                    <div class="d-flex flex-column gap-2">
                        <h2 class="text-center">Capacitación Docente</h2>
                        <span class="text-center">Favor de ingresar sus datos </span>
                    </div>
                </div>
                <form action="/login" method="POST" class="d-flex flex-column gap-4 px-xxl-5 mx-xxl-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="addon-wrapping">
                                <i class="bi bi-person"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control <?= isValidInput($errors, "username") ?>"
                                placeholder="Matrícula/usuario"
                                name="username"
                                id="username"
                                value="<?= old("username") ?>"
                                aria-label="matricula-usuario"
                                aria-describedby="addon-wrapping">
                            <div class="invalid-feedback">
                                <?= $errors['username'] ?>
                            </div>
                        </div>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="addon-wrapping">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                class="form-control <?= isValidInput($errors, "password") ?>"
                                placeholder="Contraseña"
                                id="password"
                                name="password"
                                aria-label="password"
                                aria-describedby="addon-wrapping">
                            <div class="invalid-feedback">
                                <?= $errors['password'] ?>
                            </div>
                        </div>
                        <?php if (isset($errors["general"])): ?>
                            <span class="text-danger fs-6"><?= $errors['general'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
            <div class="dropup" style="align-self: flex-end;">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-circle-half theme-icon" style="font-size: 1.5rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <button class="dropdown-item" data-theme="auto">
                            <i class="bi bi-circle-half"></i>
                            <span class="ms-2">Automático</span>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-theme="light">
                            <i class="bi bi-brightness-high"></i>
                            <span class="ms-2">Claro</span>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-theme="dark">
                            <i class="bi bi-moon"></i>
                            <span class="ms-2">Noche</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
<!-- <div class="container-fluid px-0">
    <div class="row g-0">
        <div class="col col-lg-8 vh-100">
            <img src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg" alt="Image" class="rounded img-fluid" style="object-fit: cover; height: 100%; width: 200%">
        </div>
        <div class="col col-lg-4 align-self-center justify-content-center">
            <header class="text-center">
                <h1>Capacitación Docente</h1>
                <h1><?= $title ?></h1>
            </header>
            <div class="d-flex justify-content-center">
                <form action="/login" method="POST">
                    <div class="mb-4">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control <?= isValidInput($errors, "username") ?>" id="username" name="username" value="<?= old("username") ?>">
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                    </div>
                    <input type="hidden" name="rol" value="admin" />
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
<?php view("components/footer.php"); ?>