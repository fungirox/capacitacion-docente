<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledHeader.php"; ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Oferta de Cursos</h1>
    <div class="row row-cols-auto justify-content-end pt-4 g-2">
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

    <?php if ($noCoursesFound) : ?>
        <div class="d-flex flex-column align-items-center my-5 g-4">
            <p class="h3 my-3">No hay cursos disponibles.</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-emoji-frown" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.5 3.5 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.5 4.5 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5" />
            </svg>
        </div>

    <?php else : ?>
        <div class="my-2 row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($allCourses as $course) : ?>
                <?php
                $id = $course["CURSOID"];
                $nombre = htmlspecialchars($course["CURSO_Nombre"], ENT_QUOTES, "UTF-8");
                ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="..." height="150px" style="object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $nombre ?></h5>
                            <p class="card-text">sadasdsadsaaaaaaaaaaa</p>
                            <a href="/curso?id=<?= $id ?>" class="btn btn-primary">Detalles</a>
                        </div>
                        <div class="card-footer">
                            Card footer
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>



        </div>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledFooter.php"; ?>