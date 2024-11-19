<div>
    <img src="https://www.ketchum.edu/sites/default/files/2022-08/First%20%28Top%29%20Image%20.jpeg" class="img-fluid" alt="Imagen" style="width: 100%; height: 300px; object-fit: cover;">
</div>
<?php view("components/styledHeader.php"); ?>
<main role="main" class="container pt-5">
    <div class="d-flex justify-content-between align-items-start">
        <div class="w-75 fs-4 mx-5">
            <h2 class=""><?= $nombreCurso ?></h2>
            <div class="list-inline py-2">
                <span class="list-inline-item text-capitalize badge text-bg-primary"> <?= $tipo ?> </span>
                <p class="list-inline-item text-capitalize badge text-bg-primary"> <?= $tipoCurso ?></p>
            </div>
            <div class="">
                <p class="text-primary d-inline"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                    </svg> Descargar ficha</p>
                <p class="py-4" style="text-align: justify;"><?= $descripcion ?></p>
            </div>
        </div>
        <div class="py-5">
            <div class="w-25 d-grid col-md-4 translate-middle-y">
                <img src="https://i.ibb.co/j9C8mWY/646ff0ce-d0c4-48ec-a868-f6c564204a5c.jpg" width="250" height="250" class="rounded-circle mb-4" style="object-fit: cover;">
                <div class="">
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg> Impartido por: <span class="fw-bold"> <?= $nombreInstructor ?> <?= $apellidoInstructor ?> </span></p>
                    <p> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" class="bi bi-stopwatch-fill" viewBox="0 0 16 16">
                            <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0" />
                        </svg> Duración: <span class="fw-bold"> <?= $totalHoras ?> horas </span></p>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
                        </svg> Modalidad:<span class="fw-bold text-capitalize"> <?= $modalidad ?> </span></p>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5" />
                        </svg> Fecha Inicio:<span class="fw-bold"> <?= $fechaInicio ?> </span></p>
                </div>
                <form method="POST" action="/oferta/registroDocenteCurso">
                    <input type="hidden" name="cursoid" value="<?= $id ?>">
                    <input type="hidden" name="isInscrito" value="<?= $isInscrito["isInscrito"] ?>">
                    <?php if ($isInscrito["isInscrito"] > 0): ?>
                        <button type="submit"
                            class="btn btn-danger btn-lg"
                            style="width: 200px;">
                            Salir del curso
                        </button>
                    <?php else: ?>
                        <button type="submit"
                            class="btn btn-primary btn-lg"
                            style="width: 200px;">
                            Entrar
                        </button>
                    <?php endif; ?>
                </form>

            </div>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>