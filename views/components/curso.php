<?php view("components/styledHeader.php", ["title" => $nombre]); ?>
<header style="margin-top: 56px">
    <img
        src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg"
        class="img-fluid header-image"
        alt="Imagen">
</header>
<div style="margin-top: 56px; position: fixed; top: 0; right: 0;" class="p-3">
    <?php if (strcmp($mode, "admin") === 0): ?>
        <span class="badge text-bg-secondary fs-6">Vista previa</span>
    <?php endif; ?>
</div>
<main role="main" class="container col-md-8 py-4 py-md-5">
    <div class="row">
        <div class="col-12 col-lg-8">
            <?php if (strcmp($mode, "admin") === 0): ?>
                <div class="container pb-3">
                    <div class="row gap-3">
                        <button type="button" class="col-12 col-md-auto btn btn-outline-success">
                            <i class="bi bi-flag pe-2"></i>
                            <span>Iniciar curso</span>
                        </button>
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
            <?php endif; ?>
            <?php view("components/nestedTitle.php", ["url" => "/admin/cursos", "title" => $nombre]) ?>
            <h4 class="text-secondary py-1"><?= $instructor ?></h4>
            <hr class="text-secondary" />
            <div class="row justify-content-between pb-4">
                <div class="col">
                    <?php foreach ($areas as $area): ?>
                        <span class="badge rounded-pill text-bg-primary"><?= $area ?></span>
                    <?php endforeach; ?>
                </div>
                <span class="col text-secondary text-end"><?= $tipo ?> (en curso)</span>
            </div>
            <p class="lh-lg"><?= $descripcion ?></p>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card rounded-4">
                <div class="card-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-mortarboard fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $origen ?></span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <i class="bi bi-book fs-4 text-secondary-emphasis"></i>
                                <span class="text-secondary-emphasis"><?= $perfil ?></span>
                            </div>
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
                            <?php switch ($mode):
                                case "inscrito": ?>
                                    <a type="button" class="btn btn-outline-secondary">Descargar ficha</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Salir del curso</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Salir del Curso</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Seguro de que desea cancelar su inscripción al curso "<?= $nombre ?>"?
                                                </div>
                                                <form class="modal-footer" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="id" value="<?= $id ?>" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                                    <button type="submit" class="btn btn-danger">Salir del curso</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php
                                case "oferta": ?>
                                    <a type="button" class="btn btn-outline-secondary">Descargar ficha</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Inscribirse al curso</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Inscribirse al Curso</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Seguro de que desea inscribrise al curso "<?= $nombre ?>"?
                                                </div>
                                                <form class="modal-footer" method="POST">
                                                    <input type="hidden" name="id" value="<?= $id ?>" />
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                                    <button type="submit" class="btn btn-primary">Inscribirse al curso</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php break; ?>
                            <?php endswitch; ?>
                            <?php if (!$isVirtual): ?>
                                <span class="col text-secondary text-end fst-italic"><?= $limite ?> cupos disponibles</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>