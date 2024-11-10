<?php

use Core\Roles\Roles; ?>

<header>
    <nav class="navbar bg-light fixed-top navbar-expand-lg shadow-sm user-select-none">
        <div class="container-fluid">
            <div class="navbar-brand">
                <img src="../../assets/images/icono-itesca.png" alt="Logo de ITESCA" width="24">
                <span>Capacitación Docente</span>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                    <?php if ($_SESSION["user"]["rol"] === Roles::ADMIN): ?>
                        <?php require base_path("views/components/adminNavItems.php"); ?>
                    <?php else: ?>
                        <?php require base_path("views/components/standardNavItems.php"); ?>
                    <?php endif; ?>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-light w-100 py-0 d-flex align-items-center justify-content-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-6 me-2"><?= $_SESSION["user"]["username"] ?></span>
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="/logout" method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button class="dropdown-item">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span class="ms-2">Cerrar Sesión</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>