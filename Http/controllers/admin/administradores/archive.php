<?php

use Core\App;
use Core\Repositories\AdministradorRepository;

$archive = $_POST["action"] === "archive";

App::resolve(AdministradorRepository::class)->archive($_POST["id"], $archive ? 0 : 1);

redirect("/admin/administradores");
