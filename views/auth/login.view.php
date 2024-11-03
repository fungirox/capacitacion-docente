<?php require view("components/header.php"); ?>
<main>
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col col-lg-8 vh-100">
                <img src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg" alt="Image" class="rounded img-fluid" style="object-fit: cover; height: 100%; width: 200%">
            </div>
            <div class="col col-lg-4 align-self-center justify-content-center">
                <header class="text-center">
                    <h1>Capacitación Docente</h1>
                    <h1>Log-in</h1>
                </header>
                <div class="d-flex justify-content-center">
                    <form action="/login" method="POST">
                        <div class="mb-4">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" value="">
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
    </div>
</main>
<?php require view("components/footer.php"); ?>