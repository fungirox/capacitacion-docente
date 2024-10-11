<?php require view("components/styledHeader.php"); ?>
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
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Carreras</h1>
    <div class="row row-cols-auto justify-content-end py-4 g-2">
        <div class="order-2 order-md-1 col-12 col-md-4">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="search-docente" class="form-control" placeholder="Buscar carrera..." aria-label="BuscarDocente" aria-describedby="buscar-docente">
            </div>
        </div>
        <div class="order-1 order-md-2 d-grid col-12 col-md-auto">
            <a href="carreras/nuevo" type="button" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                <span>Nueva carrera</span>
            </a>
        </div>
    </div>
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
                <?php foreach ($allCareers as $career) : ?>
                    <?php
                    $id = htmlspecialchars($career['CARRERAID']);
                    $name = htmlspecialchars($career['CARRERA_Nombre']);
                    $acronym = htmlspecialchars($career['CARRERA_Siglas']);
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
                                        <a class="dropdown-item" href="/admin/carreras/editar?id=<?= $id ?>">
                                            <i class="bi bi-pencil"></i>
                                            <span class="ms-2">Editar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $id ?>">
                                            <i class="bi bi-trash"></i>
                                            <span class="ms-2">Eliminar</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <form method="POST">
                        <div class="modal fade" id="deleteModal<?= $id ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModalLabel<?= $id ?>">Eliminar Carrera</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Seguro de que desea eliminar esta carrera?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="id" value="<?= $id ?>" />
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require view("components/styledFooter.php"); ?>