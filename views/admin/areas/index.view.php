<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <form class="row pt-4 g-2 justify-content-between" method="GET">
        <?php if ($archivados): ?>
            <input type="hidden" name="archivados" value="true">
        <?php endif; ?>
        <div class="col-12 col-md-9 col-lg-8">
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-search"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Buscar área..."
                            aria-label="BuscarArea"
                            aria-describedby="buscar-area"
                            value="<?= htmlspecialchars($search ?? "") ?>">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-sort-down"></i>
                        </span>
                        <select name="sortBy" class="form-select" aria-label="Ordenar por" onchange="this.form.submit()">
                            <option value="AREA_Nombre-ASC" <?= $sortBy . '-' . $sortOrder == 'AREA_Nombre-ASC' ? 'selected' : '' ?>>
                                ↓ Nombre
                            </option>
                            <option value="AREA_Nombre-DESC" <?= $sortBy . '-' . $sortOrder == 'AREA_Nombre-DESC' ? 'selected' : '' ?>>
                                ↑ Nombre
                            </option>
                            <option value="AREA_Siglas-ASC" <?= $sortBy . '-' . $sortOrder == 'AREA_Siglas-ASC' ? 'selected' : '' ?>>
                                ↓ Siglas
                            </option>
                            <option value="AREA_Siglas-DESC" <?= $sortBy . '-' . $sortOrder == 'AREA_Siglas-DESC' ? 'selected' : '' ?>>
                                ↑ Siglas
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$archivados): ?>
            <div class="col-12 col-md-auto">
                <div class="d-grid">
                    <a href="areas/nuevo" type="button" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Nueva área</span>
                    </a>
                </div>
            </div>
        <?php endif ?>
    </form>
    <div class="row row-cols-auto justify-content-between py-3 px-2">
        <?php if ($paramsActive): ?>
            <a class="col" href="<?= $archivados ? "?archivados=true" : "/admin/areas" ?>">
                <i class="bi bi-x me-1"></i><span>Limpiar filtros</span>
            </a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>
        <span class="col text-secondary text-end fst-italic"><?= $pagination["totalItems"] ?> áreas encontradas</span>
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
        <nav class="pt-3 pb-4" aria-label="pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $pagination["currentPage"] == 1 ? "disabled" : "" ?>">
                    <a class="page-link" href="?page=<?= $pagination["currentPage"] - 1 ?><?= $archivados ? "&archivados=true" : "" ?><?= $search ? "&search=" . urlencode($search) : "" ?><?= $sortBy && $sortOrder ? "&sortBy=" . $sortBy . "-" . $sortOrder : "" ?>">
                        Anterior
                    </a>
                </li>
                <?php for ($i = 1; $i <= $pagination["totalPages"]; $i++): ?>
                    <li class="page-item <?= $i == $pagination["currentPage"] ? "active" : "" ?>">
                        <a class="page-link" href="?page=<?= $i ?><?= $archivados ? "&archivados=true" : "" ?><?= $search ? "&search=" . urlencode($search) : "" ?><?= $sortBy && $sortOrder ? "&sortBy=" . $sortBy . "-" . $sortOrder : "" ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagination["currentPage"] == $pagination["totalPages"] ? "disabled" : "" ?>">
                    <a class="page-link" href="?page=<?= $pagination["currentPage"] + 1 ?><?= $archivados ? "&archivados=true" : "" ?><?= $search ? "&search=" . urlencode($search) : "" ?><?= $sortBy && $sortOrder ? "&sortBy=" . $sortBy . "-" . $sortOrder : "" ?>">
                        Siguiente
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif ?>
    <div class="d-flex flex-column align-items-center gap-3 pt-3">
        <span class="text-center text-secondary">¿No encuentras el área que buscas?</span>
        <a href="<?= $archivados ? "/admin/areas" : "?archivados=true" ?>" type="btn" class="btn btn-outline-secondary">
            <?= $archivados ? "Ver Áreas Activas" : "Ver Áreas Archivadas" ?>
        </a>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>