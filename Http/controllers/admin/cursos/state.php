<?php

use Core\App;
use Core\Repositories\CursoRepository;

$newState = match ($_POST["state"]) {
    "privado" => "publico",
    "publico" => "en_progreso",
    "en_progreso" => "terminado",
};

App::resolve(CursoRepository::class)->updateState($_POST["id"], $newState);

redirect("/admin/cursos/curso?id=" . $_POST["id"]);
