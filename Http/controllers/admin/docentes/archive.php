<?php

use Core\App;
use Core\Repositories\UsuarioRepository;

$archive = $_POST["action"] === "archive";

App::resolve(UsuarioRepository::class)->archive($_POST["id"], $archive ? 0 : 1);

redirect("/admin/docentes");
