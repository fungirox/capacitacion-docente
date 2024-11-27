<?php

use Core\App;
use Core\Repositories\AreaRepository;

$archivados = isset($_GET["archivados"]);
$title = $archivados ? "Áreas Archivadas" : "Áreas";
$allAreas = App::resolve(AreaRepository::class)->getAll($archivados ? 1 : 0);

return view("/admin/areas/index.view.php", [
    "title" => $title,
    "allAreas" => $allAreas,
    "archivados" => $archivados
]);
