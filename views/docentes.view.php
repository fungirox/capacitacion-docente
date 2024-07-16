<?php require "components/styledHeader.php"; ?>
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
    <h1>Docentes</h1>
    <div class="row row-cols-auto justify-content-end py-4 g-2">
        <div class="order-2 order-md-1 col-12 col-md-4">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="search-docente" class="form-control" placeholder="Buscar docente..." aria-label="BuscarDocente" aria-describedby="buscar-docente">
            </div>
        </div>
        <div class="order-1 order-md-2 d-grid col-12 col-md-auto">
            <a href="/nuevo-docente" type="button" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                <span>Nuevo Docente</span>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Nómina</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">42069</td>
                    <td>John Doe</td>
                    <td>5vqJt@example.com</td>
                    <td>555-555-5555</td>
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
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">42069</td>
                    <td>Hoe Man</td>
                    <td>5vqJt@example.com</td>
                    <td>555-555-5555</td>
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
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">42069</td>
                    <td>Booba Pussa</td>
                    <td>5vqJt@example.com</td>
                    <td>555-555-5555</td>
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
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php require "components/styledFooter.php"; ?>