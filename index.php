<?php
require_once "config/config.php";
if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capacitación Docente ITESCA</title>
    <link rel="icon" href="assets/images/icono-itesca.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="assets/js/routing.js"></script>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary shadow-sm user-select-none">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <img src="assets/images/icono-itesca.png" alt="Logo de ITESCA" width="29" class="d-inline-block align-text-top">
                    <span>Capacitación Docente</span>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="oferta">Oferta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="inscritos">Inscritos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="instruyendo">Instruyendo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="horario">Horario</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="historial">Historial</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="w-100 btn btn-light py-0 d-flex align-items-center justify-content-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fs-6 me-2">User</span>
                            <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="modules/logOut.php">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span class="ms-2">Cerrar Sesión</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="main-container">
        <div id="page" class="container py-4"></div>
    </main>
    <hr class="container">
    <footer class="py-4">
        <p class="text-center text-body-secondary">© Copyright 2024 ITESCA - Todos los Derechos Reservados</p>
    </footer>
</body>

</html>