<?php

use Core\App;
use Core\Repositories\CarreraRepository;

$archive = $_POST["action"] === "archive";

App::resolve(CarreraRepository::class)->archive($_POST["id"], $archive ? 1 : 0);

redirect("/admin/carreras");
