<?php view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Cursos</h1>
    <div class="row row-cols-auto justify-content-end pt-4 g-2">
        <div class="order-1 order-md-2 d-grid col-12 col-md-auto">
            <a href="cursos/nuevo" type="button" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                <span>Nuevo curso</span>
            </a>
        </div>
        <div class="col-12 col-md-auto">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar curso..." aria-label="Username" aria-describedby="addon-wrapping">
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-filter"></i></span>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Filtrar</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <select class="form-select" aria-label="Default select example">
                <option selected>Ordenar por</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>
    <div class="my-2 row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($allCourses as $course) : ?>
            <?php
            $id = htmlspecialchars($course["CURSOID"]);
            $nombre = htmlspecialchars($course["CURSO_Nombre"]);
            $instructorNombre = htmlspecialchars($course["instructor_nombre"]);
            $duracion = htmlspecialchars($course["CURSO_Total_Horas"] . " horas");

            $tipo = htmlspecialchars($course["CURSO_Tipo"]);
            $tipoColor = $tipo === "curso" ? "text-bg-primary" : "text-bg-warning";

            $modalidad = htmlspecialchars($course["CURSO_Modalidad"]);
            $modalidadColor = match ($modalidad) {
                "virtual" => "text-bg-success",
                "presencial" => "text-bg-danger",
                "hibrido" => "text-bg-info"
            };
            $modalidad = $modalidad === "hibrido" ? "híbrido" : $modalidad;
            ?>
            <div class="col">
                <div class="card h-100">
                    <a href="/admin/curso?id=<?= $id ?>">
                        <img
                            src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="card-img-top"
                            height="160px"
                            style="object-fit: cover"
                            alt="Portada del curso">
                    </a>
                    <div class="card-body flex-grow-1 d-flex flex-column">
                        <a class="h5 card-title link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/admin/cursos/curso?id=<?= $id ?>">
                            <?= $nombre ?>
                        </a>
                        <span class="card-text"><?= $instructorNombre ?></span>
                    </div>
                    <div class="card-footer px-4 gap-2 d-flex justify-content-between align-items-center">
                        <div class="row gap-2">
                            <span class="col-auto text-capitalize badge rounded-pill <?= $tipoColor ?>"> <?= $tipo ?> </span>
                            <span class="col-auto text-capitalize badge rounded-pill <?= $modalidadColor ?>"> <?= $modalidad ?></span>
                        </div>
                        <span class="text-secondary text-end"><?= $duracion ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>