<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container col-xl-8 py-5" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <?php if (empty($allCursos)): ?>
        <div class="d-flex flex-column align-items-center py-5 gap-2">
            <i class="bi bi-emoji-frown fs-1 text-secondary"></i>
            <span class="text-secondary">No te has inscrito a ningún curso.</span>
            <a href="/oferta" class="btn btn-outline-secondary mt-4">Ver Oferta de Cursos</a>
        </div>
    <?php else: ?>
        <div class="my-4 row gap-4">
            <?php foreach ($allCursos as $curso) : ?>
                <?php
                $id = htmlspecialchars($curso["id"]);
                $nombre = htmlspecialchars($curso["nombre"]);
                $tipo = htmlspecialchars(ucfirst($curso["tipo"]));
                $instructorNombre = htmlspecialchars($curso["instructor_nombre"]);
                $aula = htmlspecialchars($curso["aula"]);
                $duración = htmlspecialchars(formattedDateRange(formatDate($curso["inicio"]), formatDate($curso["final"])));
                $dias = htmlspecialchars(shortFormattedDays($curso["dias"]));
                $hora = htmlspecialchars(formattedHourRange($curso["hora_inicial"], $curso["hora_final"]));
                ?>
                <div class="col-12"> 
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="row">
                                <a class="col-auto" href="/inscritos/curso?id=<?= $id ?>">
                                    <img
                                        src="https://plus.unsplash.com/premium_photo-1682125773446-259ce64f9dd7?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        height="100px"
                                        width="100px"
                                        style="object-fit: cover; aspect-ratio: 1; border-radius: 4px"
                                        alt="Portada del curso">
                                </a>
                                <div class="col-6">
                                    <a class="h4 card-title link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/inscritos/curso?id=<?= $id ?>">
                                        <?= $nombre ?>
                                    </a>
                                    <p class="card-text text-secondary-emphasis pt-2"><?= $instructorNombre ?></p>
                                </div>
                                <div class="col text-end"><span class="badge text-bg-primary"><?= $tipo ?></span></div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom-4 d-flex justify-content-center align-items-center gap-2">
                            <?php if ($curso["modalidad"] !== "virtual"): ?>
                                <span class="text-secondary text-center"><?= $aula ?></span>
                                <i class="bi bi-dot text-secondary"></i>
                                <span class="text-secondary text-center"><?= $dias ?></span>
                                <i class="bi bi-dot text-secondary"></i>
                                <span class="text-secondary text-center"><?= $hora ?></span>
                                <i class="bi bi-dot text-secondary"></i>
                            <?php endif ?>
                            <span class="text-secondary text-center"><?= $duración ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php view("components/styledFooter.php"); ?>