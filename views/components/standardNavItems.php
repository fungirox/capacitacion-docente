<?php

use Core\Roles\Roles;
use Core\Session;

?>

<?php if (Session::role() === Roles::DOCENTE_AND_INSTRUCTOR || Session::role() === Roles::DOCENTE): ?>
    <li class="nav-item">
        <a href="/inscritos" class="nav-link <?= urlIs("/inscritos") ? "active" : null ?>" aria-current="<?= urlIs("/inscritos") ? "page" : null ?>" id="inscritos">Inscritos</a>
    </li>
    <li class="nav-item">
        <a href="/oferta" class="nav-link <?= urlIs("/oferta") ? "active" : null ?>" aria-current="<?= urlIs("/oferta") ? "page" : null ?>" id="oferta">Oferta</a>
    </li>
<?php endif; ?>
<?php if (Session::role() === Roles::DOCENTE_AND_INSTRUCTOR || Session::role() === Roles::INSTRUCTOR): ?>
    <li class="nav-item">
        <a href="/instruyendo" class="nav-link <?= urlIs("/instruyendo") ? "active" : null ?>" aria-current="<?= urlIs("/instruyendo") ? "page" : null ?>" id="instruyendo">Instruyendo</a>
    </li>
<?php endif; ?>
<li class="nav-item">
    <a href="/historial" class="nav-link <?= urlIs("/historial") ? "active" : null ?>" aria-current="<?= urlIs("/historial") ? "page" : null ?>" id="historial">Historial</a>
</li>