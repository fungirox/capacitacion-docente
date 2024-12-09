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
                            placeholder="Buscar curso..."
                            aria-label="BuscarCurso"
                            aria-describedby="buscar-curso"
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
                            <option value="CURSOID-DESC" <?= $sortBy . '-' . $sortOrder == 'CURSOID-DESC' ? 'selected' : '' ?>>
                                ↓ Más recientes
                            </option>
                            <option value="CURSOID-ASC" <?= $sortBy . '-' . $sortOrder == 'CURSOID-ASC' ? 'selected' : '' ?>>
                                ↓ Más antigüos
                            </option>
                            <option value="CURSO_Nombre-ASC" <?= $sortBy . '-' . $sortOrder == 'CURSO_Nombre-ASC' ? 'selected' : '' ?>>
                                ↓ Nombre
                            </option>
                            <option value="CURSO_Nombre-DESC" <?= $sortBy . '-' . $sortOrder == 'CURSO_Nombre-DESC' ? 'selected' : '' ?>>
                                ↑ Nombre
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-funnel"></i>
                        </span>
                        <select name="filterBy" class="form-select" aria-label="Filtrar por modalidad" onchange="this.form.submit()">
                            <option value="" <?= empty($filterBy) ? 'selected' : '' ?>>
                                Todos los servicios
                            </option>
                            <option value="presencial" <?= $filterBy == 'presencial' ? 'selected' : '' ?>>
                                Servicios presenciales
                            </option>
                            <option value="virtual" <?= $filterBy == 'virtual' ? 'selected' : '' ?>>
                                Servicios virtuales
                            </option>
                            <option value="hibrido" <?= $filterBy == 'hibrido' ? 'selected' : '' ?>>
                                Servicios híbridos
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$archivados): ?>
            <div class="col-12 col-md-auto">
                <div class="d-grid">
                    <a href="cursos/nuevo" type="button" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        <span>Nuevo curso</span>
                    </a>
                </div>
            </div>
        <?php endif ?>
    </form>
    <div class="row row-cols-auto justify-content-between py-3 px-2">
        <?php if ($paramsActive): ?>
            <a class="col" href="<?= $archivados ? "?archivados=true" : "/admin/cursos" ?>">
                <i class="bi bi-x me-1"></i><span>Limpiar filtros</span>
            </a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>
        <span class="col text-secondary text-end fst-italic">
            <?= $pagination["totalItems"] ?> <?= $pagination["totalItems"] == 1 ? "curso encontrado" : "cursos encontrados" ?>
        </span>
    </div>
    <?php if (empty($allCursos)): ?>
        <?php view("components/emptyList.php") ?>
    <?php else: ?>
        <div class="mb-3 row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($allCursos as $curso) : ?>
                <?php
                $id = htmlspecialchars($curso["id"]);
                $nombre = htmlspecialchars($curso["nombre"]);
                $instructorNombre = htmlspecialchars($curso["instructor_nombre"]);
                $tipo = htmlspecialchars(ucfirst($curso["tipo"]));
                ?>
                <div class="col">
                    <div class="card h-100 rounded-4">
                        <a href="/admin/curso?id=<?= $id ?>">
                            <div class="pt-2 pe-3 shadow-sm" style="position: absolute; right: 0">
                                <span class="badge bg-success">En progreso</span>
                            </div>
                            <img
                                src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="card-img-top rounded-top-4"
                                height="160px"
                                style="object-fit: cover"
                                alt="Portada del curso">
                        </a>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a class="h5 card-title link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/admin/cursos/curso?id=<?= $id ?>">
                                    <?= $nombre ?>
                                </a>
                                <div class="dropup">
                                    <button class="btn rounded-pill btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="/admin/cursos/activar<?= $id ?>">
                                                <i class="bi bi-flag"></i>
                                                <span class="ms-2">Iniciar curso</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/admin/cursos/editar?id=<?= $id ?>">
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
                            </div>
                            <form method="POST">
                                <div class="modal fade" id="archiveModal<?= $id ?>" tabindex="-1" aria-labelledby="archiveModalLabel<?= $id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="archiveModalLabel<?= $id ?>"><?= $archivados ? "Desarchivar" : "Archivar" ?> Curso</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Seguro de que desea <?= $archivados ? "desarchivar" : "archivar" ?> este curso?</p>
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
                            <p class="card-text text-secondary-emphasis pt-1"><?= $instructorNombre ?></p>
                        </div>
                        <div class="card-footer rounded-bottom-4 d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <?php foreach ($curso["areas"] as $area): ?>
                                    <?php if (!empty($area)): ?>
                                        <span class="col-auto text-capitalize badge rounded-pill text-bg-primary"> <?= $area ?> </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <span class="text-secondary text-end"><small><?= $tipo ?></small></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
        <span class="text-center text-secondary">¿No encuentras el curso que buscas?</span>
        <a href="<?= $archivados ? "/admin/cursos" : "?archivados=true" ?>" type="btn" class="btn btn-outline-secondary">
            <?= $archivados ? "Ver cursos activos" : "Ver cursos archivados" ?>
        </a>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>