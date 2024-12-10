<?php

use Core\App;
use Core\Repositories\AreaRepository;
use Core\Repositories\InstructorRepository;

$instructores = App::resolve(InstructorRepository::class)->getAll();
$areas = App::resolve(AreaRepository::class)->getAll();

return view("admin/cursos/create.view.php", [
    "title" => "Registrar Servicio",
    "instructores" => $instructores,
    "areas" => $areas,
]);
