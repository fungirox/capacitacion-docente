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
    <a href="/horario" class="nav-link <?= urlIs("/horario") ? "active" : null ?>" aria-current="<?= urlIs("/horario") ? "page" : null ?>" id="horario">Horario</a>
</li>
<li class="nav-item">
    <a href="/historial" class="nav-link <?= urlIs("/historial") ? "active" : null ?>" aria-current="<?= urlIs("/historial") ? "page" : null ?>" id="historial">Historial</a>
</li>