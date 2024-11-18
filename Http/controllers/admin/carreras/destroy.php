<?php

use Core\App;
use Core\Repositories\CarreraRepository;

App::resolve(CarreraRepository::class)->delete($_POST["id"]);

redirect("/admin/carreras");
