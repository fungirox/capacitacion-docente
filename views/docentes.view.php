<?php require "components/styledHeader.php"; ?>
<main role="main" class="container pt-4" style="margin-top: 56px">
    <h1>Docentes</h1>
    <div class="py-4">
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Buscar docente...">
    </div>
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
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
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
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
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
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
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</main>
<?php require "components/styledFooter.php"; ?>