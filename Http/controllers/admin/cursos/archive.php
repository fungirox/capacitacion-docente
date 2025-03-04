<?php

use Core\App;
use Core\Repositories\CursoRepository;

$archive = $_POST["action"] === "archive";

App::resolve(CursoRepository::class)->archive($_POST["id"], $archive ? 1 : 0);

if(!$archive){
    App::resolve(CursoRepository::class)->updateReprogramado($_POST["id"]);
}

redirect("/admin/cursos");
