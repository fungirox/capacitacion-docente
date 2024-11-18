<?php

use Core\App;
use Core\Repositories\AreaRepository;

return view("/admin/areas/index.view.php", [
    "title" => "Áreas",
    "allAreas" => App::resolve(AreaRepository::class)->getAll()
]);
