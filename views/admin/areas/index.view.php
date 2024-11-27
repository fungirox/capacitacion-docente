<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script defer>
    $(document).ready(function() {
        $("#search-docente").on("keyup", function() {
            const value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="row row-cols-auto justify-content-end py-4 g-2">
        <?php if (!empty($allAreas)): ?>
            <div class="order-2 order-md-1 col-12 col-md-4">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="search-docente" class="form-control" placeholder="Buscar área..." aria-label="BuscarDocente" aria-describedby="buscar-docente">
                </div>
            </div>
        <?php endif ?>
        <?php if (!$archivados): ?>
            <div class="order-1 order-md-2 d-grid col-12 col-md-auto">
                <a href="areas/nuevo" type="button" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Nueva área</span>
                </a>
            </div>
        <?php endif ?>
    </div>
    <?php if (empty($allAreas)): ?>
        <?php view("components/emptyList.php") ?>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Siglas</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allAreas as $area) : ?>
                        <?php
                        $id = htmlspecialchars($area['id']);
                        $name = htmlspecialchars($area['nombre']);
                        $acronym = htmlspecialchars($area['siglas']);
                        ?>
                        <tr>
                            <td><?= $name ?></td>
                            <td><?= $acronym ?></td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="/admin/areas/editar?id=<?= $id ?>">
                                                <i class="bi bi-pencil"></i>
                                                <span class="ms-2">Editar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#archiveModal<?= $id ?>">
                                                <i class="bi bi-archive"></i>
                                                <span class="ms-2"><?= $archivados ? "Desarchivar" : "Archivar" ?></span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <form method="POST">
                            <div class="modal fade" id="archiveModal<?= $id ?>" tabindex="-1" aria-labelledby="archiveModalLabel<?= $id ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="archiveModalLabel<?= $id ?>"><?= $archivados ? "Desarchivar" : "Archivar" ?> Área</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Seguro de que desea <?= $archivados ? "desarchivar" : "archivar" ?> esta área?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <input type="hidden" name="id" value="<?= $id ?>" />
                                            <input type="hidden" name="action" value="<?= $archivados ? "unarchive" : "archive" ?>" />
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-warning"><?= $archivados ? "Desarchivar" : "Archivar" ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
    <div class="d-flex flex-column align-items-center gap-3 pt-3">
        <span class="text-center text-secondary">¿No encuentras el área que buscas?</span>
        <a href="<?= $archivados ? "/admin/areas" : "?archivados" ?>" type="btn" class="btn btn-outline-secondary">
            <?= $archivados ? "Ver Áreas Activas" : "Ver Áreas Archivadas" ?>
        </a>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>