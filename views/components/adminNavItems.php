<li class="nav-item">
    <a href="/admin/cursos" class="nav-link <?= urlIs("/admin/cursos") ? "active" : null ?>" aria-current="<?= urlIs("/admin/cursos") ? "page" : null ?>" id="cursos">Cursos</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle <?= urlIs("/admin/docentes") || urlIs("/admin/instructores") || urlIs("/admin/administradores") ? "active" : null ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Usuarios
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item <?= urlIs("/admin/docentes") ? "active" : null ?>" href="/admin/docentes">Docentes</a></li>
        <li><a class="dropdown-item <?= urlIs("/admin/instructores") ? "active" : null ?>" href="/admin/instructores">Instructores</a></li>
        <li><a class="dropdown-item <?= urlIs("/admin/administradores") ? "active" : null ?>" href="/admin/administradores">Administradores</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Documentación
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/admin/reportes">Reportes</a></li>
        <li><a class="dropdown-item" href="/admin/formatos">Formatos</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle <?= urlIs("/admin/personal") || urlIs("/admin/areas") || urlIs("/admin/carreras") ? "active" : null ?>" href="#" role="button" data-bs-toggle="dropdown" aria-current="<?= urlIs("/admin/personal") || urlIs("/admin/areas") || urlIs("/admin/carreras") ? "page" : null ?> aria-expanded=" false">
        Académico
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item <?= urlIs("/admin/personal") ? "active" : null ?>" href="/admin/personal">Personal</a></li>
        <li><a class="dropdown-item <?= urlIs("/admin/areas") ? "active" : null ?>" href="/admin/areas">Áreas</a></li>
    </ul>
</li>