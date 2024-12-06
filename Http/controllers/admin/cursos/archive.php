<?php

use Core\App;
use Core\Repositories\CursoRepository;

$archive = $_POST["action"] === "archive";

App::resolve(CursoRepository::class)->archive($_POST["id"], $archive ? 1 : 0);

redirect("/admin/cursos");
