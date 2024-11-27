<?php view("components/styledHeader.php", ["title" => $nombre]); ?>
<style>
    .header-image {
        width: 100%;
        height: 18vh;
        object-fit: cover;
    }

    @media (min-width: 768px) {
        .header-image {
            height: 28vh;
        }
    }
</style>
<header style="margin-top: 56px">
    <img
        src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg"
        class="img-fluid header-image"
        alt="Imagen">
</header>
<main role="main" class="container col-md-8 py-4">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="container pb-3">
                <div class="row gap-3">
                    <button type="button" class="col-12 col-md-auto btn btn-outline-primary">
                        <i class="bi bi-pencil pe-2"></i>
                        <span>Editar</span>
                    </button>
                    <button type="button" class="col-12 col-md-auto btn btn-outline-warning">
                        <i class="bi bi-archive pe-2"></i>
                        <span>Archivar</span>
                    </button>
                </div>
            </div>
            <h1><?= $nombre ?></h1>
            <h5 class="text-secondary"><?= $instructor ?></h5>
            <hr class="text-secondary" />
            <div class="row justify-content-between pb-4">
                <div class="col">
                    <?php foreach ($areas as $area): ?>
                        <span class="badge rounded-pill text-bg-primary"><?= $area ?></span>
                    <?php endforeach; ?>
                </div>
                <span class="col text-secondary text-capitalize text-end"><?= $tipo ?></span>
            </div>
            <p><?= $descripcion ?></p>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-stopwatch fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $duracion . " Horas" ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-calendar3 fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $inicio . " - " . $final ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-geo-alt fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= "Aula 515" ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-calendar3-week fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= "Lunes, Miércoles, Jueves, Viernes" ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-alarm fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= "8:00 AM - 10:00 AM" ?></span>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <button type="button" class="btn btn-outline-primary">Descargar Ficha</button>
                            <button type="button" class="btn btn-primary">Entrar al Curso</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>