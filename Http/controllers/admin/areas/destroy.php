<?php

use Core\App;
use Core\Database;
use Core\Repositories\AreaRepository;

App::resolve(AreaRepository::class)->delete($_POST["id"]);

redirect("/admin/areas");
