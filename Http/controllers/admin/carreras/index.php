<?php

use Core\App;
use Core\Repositories\CarreraRepository;

$archivados = isset($_GET["archivados"]);
$title = $archivados ? "Carreras Archivadas" : "Carreras";
$allCarreras = App::resolve(CarreraRepository::class)->getAll($archivados ? 1 : 0);

return view("admin/carreras/index.view.php", [
    "title" => $title,
    "allCarreras" => $allCarreras,
    "archivados" => $archivados
]);
