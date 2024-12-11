<li class="nav-item">
    <a href="/admin/cursos" class="nav-link <?= urlIs("/admin/cursos") ? "active" : null ?>" aria-current="<?= urlIs("/admin/cursos") ? "page" : null ?>" id="cursos">Cursos</a>
</li>
<li class="nav-item">
    <a href="/admin/historial" class="nav-link <?= urlIs("/admin/historial") ? "active" : null ?>" aria-current="<?= urlIs("/admin/historial") ? "page" : null ?>" id="historial">Historial</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Usuarios
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Docentes</a></li>
        <li><a class="dropdown-item" href="#">Instructores</a></li>
        <li><a class="dropdown-item" href="#">Administradores</a></li>
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
    <a class="nav-link dropdown-toggle <?= urlIs("/admin/areas") || urlIs("/admin/carreras") ? "active" : null ?>" href="#" role="button" data-bs-toggle="dropdown" aria-current="<?= urlIs("/admin/areas") || urlIs("/admin/carreras") ? "page" : null ?> aria-expanded=" false">
        Académico
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item <?= urlIs("/admin/areas") ? "active" : null ?>" href="/admin/areas">Áreas</a></li>
        <li><a class="dropdown-item <?= urlIs("/admin/carreras") ? "active" : null ?>" href="/admin/carreras">Carreras</a></li>
    </ul>
</li>