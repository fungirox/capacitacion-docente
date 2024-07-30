<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledHeader.php"; ?>
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
                    <th scope="col">ID</th>
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
                        <td scope="row"><?= $id ?></td>
                        <td><?= $name ?></td>
                        <td><?= $acronym ?></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-pencil"></i>
                                            <span class="ms-2">Editar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-trash"></i>
                                            <span class="ms-2">Borrar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledFooter.php"; ?>