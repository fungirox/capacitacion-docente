<?php

use Core\App;
use Core\Repositories\AreaRepository;

$archive = $_POST["action"] === "archive";

App::resolve(AreaRepository::class)->archive($_POST["id"], $archive ? 1 : 0);

redirect("/admin/areas");
