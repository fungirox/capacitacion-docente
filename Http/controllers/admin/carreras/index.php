<?php

use Core\App;
use Core\Repositories\CarreraRepository;

return view("admin/carreras/index.view.php", [
    "title" => "Carreras",
    "allCareers" => App::resolve(CarreraRepository::class)->getAll()
]);
