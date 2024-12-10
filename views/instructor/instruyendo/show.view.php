<?php view("components/styledHeader.php", ["title" => $nombre]); ?>
<header style="margin-top: 56px">
    <img
        src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg"
        class="img-fluid header-image"
        alt="Imagen">
</header>
<main role="main" class="container col-md-8 py-4 py-md-5">
    <div class="row">
        <div class="col-12 col-lg-8">
            <h1><?= $nombre ?></h1>
            <h4 class="text-secondary py-1"><?= $instructor ?></h4>
            <hr class="text-secondary" />
            <div class="row justify-content-between pb-4">
                <div class="col">
                    <?php foreach ($areas as $area): ?>
                        <span class="badge rounded-pill text-bg-primary"><?= $area ?></span>
                    <?php endforeach; ?>
                </div>
                <span class="col text-secondary text-end"><?= $tipo ?></span>
            </div>
            <p class="lh-lg"><?= $descripcion ?></p>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card rounded-4">
                <div class="card-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-stopwatch fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $duracion . " Horas" ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-calendar3 fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $fechas ?></span>
                            </div>
                            <?php if (!$isVirtual): ?>
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="bi bi-geo-alt fs-4 text-secondary-emphasis"></i>
                                    <span class="text-secondary-emphasis"><?= $aula ?></span>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="bi bi-calendar3-week fs-4 text-secondary-emphasis"></i>
                                    <span class="text-secondary-emphasis"><?= $dias ?></span>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="bi bi-alarm fs-4 text-secondary-emphasis"></i>
                                    <span class="text-secondary-emphasis"><?= $horas ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <a type="button" class="btn btn-outline-secondary">Descargar ficha</a>
                            <button type="button" class="btn btn-primary">Tomar asistencia</button>
                            <?php if (!$isVirtual): ?>
                                <span class="col text-secondary text-end fst-italic"># cupos disponibles</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>