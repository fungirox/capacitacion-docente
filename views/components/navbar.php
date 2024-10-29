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
                    <li class="nav-item">
                        <a href="/admin/cursos" class="nav-link <?= urlIs("/admin/cursos") ? "active" : null ?>" aria-current="<?= urlIs("/admin/cursos") ? "page" : null ?>" id="cursos">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/historial" class="nav-link <?= urlIs("/admin/historial") ? "active" : null ?>" aria-current="<?= urlIs("/admin/historial") ? "page" : null ?>" id="historial">Historial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Personal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/admin/usuarios">Usuarios</a></li>
                            <li><a class="dropdown-item" href="/admin/docentes">Docentes</a></li>
                            <li><a class="dropdown-item" href="/admin/instructores">Instructores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Documentación
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Reportes</a></li>
                            <li><a class="dropdown-item" href="#">Formatos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= urlIs("/admin/areas") || urlIs("/admin/carreras") ? "active" : null ?>" href="#" role="button" data-bs-toggle="dropdown" aria-current="<?= urlIs("/admin/areas") || urlIs("/admin/carreras") ? "page" : null ?> aria-expanded=" false">
                            Académico
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= urlIs("/admin/areas") ? "active" : null ?>" href="/admin/areas">Áreas</a></li>
                            <li><a class="dropdown-item <?= urlIs("/admin/carreras") ? "active" : null ?>" href="/admin/carreras">Carreras</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="/oferta" class="nav-link <?= urlIs("/oferta") || urlIs("/curso") ? "active" : null ?>" aria-current="<?= urlIs("/oferta")  || urlIs("/curso") ? "page" : null ?>" id="oferta">Oferta</a>
                    </li>
                    <li class="nav-item">
                        <a href="/inscritos" class="nav-link <?= urlIs("/inscritos") ? "active" : null ?>" aria-current="<?= urlIs("/inscritos") ? "page" : null ?>" id="inscritos">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/instruyendo" class="nav-link <?= urlIs("/instruyendo") ? "active" : null ?>" aria-current="<?= urlIs("/instruyendo") ? "page" : null ?>" id="instruyendo">Instruyendo</a>
                    </li>
                    <li class="nav-item">
                        <a href="/docentes" class="nav-link <?= urlIs("/docentes") || urlIs("/docentes/nuevo") ? "active" : null ?>" aria-current="<?= urlIs("/docentes") || urlIs("/docentes/nuevo") ? "page" : null ?>" id="docentes">Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a href="/horario" class="nav-link <?= urlIs("/horario") ? "active" : null ?>" aria-current="<?= urlIs("/horario") ? "page" : null ?>" id="horario">Horario</a>
                    </li>
                    <li class="nav-item">
                        <a href="/historial" class="nav-link <?= urlIs("/historial") ? "active" : null ?>" aria-current="<?= urlIs("/historial") ? "page" : null ?>" id="historial">Historial</a>
                    </li> -->
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