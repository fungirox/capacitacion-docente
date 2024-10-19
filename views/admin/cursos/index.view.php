<?php require view("components/styledHeader.php"); ?>
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
            $id = $course["CURSOID"];
            $nombre = htmlspecialchars($course["CURSO_Nombre"], ENT_QUOTES, "UTF-8");

            $instructorQuery = $db->query("SELECT tblUsuario.USER_Nombre, tblUsuario.USER_Apellido  
            FROM tblUsuario 
            INNER JOIN tblInstructor ON tblUsuario.USERID = tblInstructor.USERID 
            INNER JOIN tblCursoInstructor ON tblCursoInstructor.INSTRUCTORID = tblInstructor.INSTRUCTORID
            INNER JOIN tblCurso ON tblCurso.CURSOID = tblCursoInstructor.CURSOID
            WHERE tblCurso.CURSOID = ?", [$id])->get();

            if ($instructorQuery) {
                $nombreInstructor = htmlspecialchars($instructorQuery['USER_Nombre'], ENT_QUOTES, "UTF-8");
                $apellidoInstructor = htmlspecialchars($instructorQuery['USER_Apellido'], ENT_QUOTES, "UTF-8");
            } else {
                $nombreInstructor = "Instructor";
                $apellidoInstructor = "no encontrado";
            }

            $tipo = htmlspecialchars($course["CURSO_Tipo"], ENT_QUOTES, "UTF-8");

            $modalidad = htmlspecialchars($course["CURSO_Modalidad"], ENT_QUOTES, "UTF-8");

            ?>
            <div class="col">
                <div class="card h-100 d-flex flex-column">
                    <a class="link-dark link-offset-2 link-underline link-underline-opacity-0 d-flex flex-column h-100" href="curso?id=<?= $id ?>">
                        <img src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="..." height="150px" style="object-fit:cover;">
                        <div class="card-body flex-grow-1 d-flex flex-column">
                            <h5 class="card-title"><?= $nombre ?></h5>
                            <p class="card-text"><?= $nombreInstructor ?> <?= $apellidoInstructor ?> </p>
                        </div>

                        <div class="card-footer mt-auto">
                            <span class="list-inline-item text-capitalize badge text-bg-primary"> <?= $tipo ?> </span>
                            <p class="list-inline-item text-capitalize badge text-bg-primary"> <?= $modalidad ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require view("components/styledFooter.php"); ?>