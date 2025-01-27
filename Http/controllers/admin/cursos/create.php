<?php

use Core\App;
use Core\Repositories\AreaRepository;
use Core\Repositories\InstructorRepository;
use Core\Session;

$instructores = App::resolve(InstructorRepository::class)->getAll();
$areas = App::resolve(AreaRepository::class)->getAll();

return view("admin/cursos/create.view.php", [
    "title" => "Registrar Servicio",
    "errors" => Session::get("errors"),
    "instructores" => $instructores,
    "areas" => $areas,
    "days" => [
        'lunes' => 'Lunes',
        'martes' => 'Martes',
        'miercoles' => 'Miércoles',
        'jueves' => 'Jueves',
        'viernes' => 'Viernes'
    ]
]);
