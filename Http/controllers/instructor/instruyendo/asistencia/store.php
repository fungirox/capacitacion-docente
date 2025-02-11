<?php

use Core\App;
use Core\Repositories\AsistenciaCursoRepository;

App::resolve(AsistenciaCursoRepository::class)->createAsistencia(
    $_POST["id"],
    (new DateTime())->format("m-d-y"),
    $_POST["alumnos"]
);

redirect("/instruyendo");
