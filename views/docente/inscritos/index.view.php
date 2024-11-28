<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container col-xl-8 py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="my-4 row gap-4">
        <?php foreach ($allCursos as $curso) : ?>
            <?php
            $id = htmlspecialchars($curso["id"]);
            $nombre = htmlspecialchars($curso["nombre"]);
            $tipo = htmlspecialchars($curso["tipo"]);
            $instructorNombre = htmlspecialchars($curso["instructor_nombre"]);
            $aula = htmlspecialchars($curso["aula"]);
            $duración = htmlspecialchars(formattedDateRange(formatDate($curso["inicio"]), formatDate($curso["final"])));
            ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <a class="col-auto" href="/oferta/curso?id=<?= $id ?>">
                                <img
                                    src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    height="100px"
                                    width="100px"
                                    style="object-fit: cover; aspect-ratio: 1; border-radius: 4px"
                                    alt="Portada del curso">
                            </a>
                            <div class="col-6">
                                <a class="h4 card-title link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/oferta/curso?id=<?= $id ?>">
                                    <?= $nombre ?>
                                </a>
                                <p class="card-text text-secondary-emphasis pt-2"><?= $instructorNombre ?></p>
                            </div>
                            <div class="col text-end"><span class="badge text-bg-primary text-capitalize"><?= $tipo ?></span></div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center align-items-center gap-2">
                        <?php if ($curso["modalidad"] !== "virtual"): ?>
                            <span class="text-secondary text-center"><?= $aula ?></span>
                            <i class="bi bi-dot text-secondary"></i>
                            <span class="text-secondary text-center">LU MA JU VI</span>
                            <i class="bi bi-dot text-secondary"></i>
                            <span class="text-secondary text-center">8:00 AM - 10:00 AM</span>
                            <i class="bi bi-dot text-secondary"></i>
                        <?php endif ?>
                        <span class="text-secondary text-center"><?= $duración ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>