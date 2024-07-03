<header class="text-center">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Capacitación Docente ITESCA</title>
    <link rel="icon" href="assets/images/icono-itesca.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</header>

<body>
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
                        <form action="modules/authenticate.php" method="post">
                            <div class="mb-4">
                                <label for="user" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="" value="">
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>