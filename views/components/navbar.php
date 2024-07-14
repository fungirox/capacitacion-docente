<header>
    <nav class="navbar bg-light fixed-top navbar-expand-lg shadow-sm user-select-none">
        <div class="container-fluid">
            <div class="navbar-brand">
                <img src="__DIR__../../assets/images/icono-itesca.png" alt="Logo de ITESCA" width="24">
                <span>Capacitación Docente</span>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/oferta" class="nav-link <?= urlIs("/oferta") || urlIs("/curso") ? "active" : null ?>" aria-current="<?= urlIs("/oferta")  || urlIs("/curso") ? "page" : null ?>" id="oferta">Oferta</a>
                    </li>
                    <li class="nav-item">
                        <a href="/inscritos" class="nav-link <?= urlIs("/inscritos") ? "active" : null ?>" aria-current="<?= urlIs("/inscritos") ? "page" : null ?>" id="inscritos">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/instruyendo" class="nav-link <?= urlIs("/instruyendo") ? "active" : null ?>" aria-current="<?= urlIs("/instruyendo") ? "page" : null ?>" id="instruyendo">Instruyendo</a>
                    </li>
                    <li class="nav-item">
                        <a href="/docentes" class="nav-link <?= urlIs("/docentes") ? "active" : null ?>" aria-current="<?= urlIs("/docentes") ? "page" : null ?>" id="docentes">Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a href="/horario" class="nav-link <?= urlIs("/horario") ? "active" : null ?>" aria-current="<?= urlIs("/horario") ? "page" : null ?>" id="horario">Horario</a>
                    </li>
                    <li class="nav-item">
                        <a href="/historial" class="nav-link <?= urlIs("/historial") ? "active" : null ?>" aria-current="<?= urlIs("/historial") ? "page" : null ?>" id="historial">Historial</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-light w-100 py-0 d-flex align-items-center justify-content-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-6 me-2">User</span>
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="/logout">
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