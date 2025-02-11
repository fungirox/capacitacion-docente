<?php

use Core\App;
use Core\Repositories\PersonalRepository;

$archive = $_POST["action"] === "archive";

App::resolve(PersonalRepository::class)->archive($_POST["id"], $archive ? 1 : 0);

redirect("/admin/personal");
