<?php

use Core\App;
use Core\Repositories\AreaRepository;
use Core\Session;
use Core\Repositories\CursoRepository;
use Core\Repositories\InstructorRepository;

$curso = App::resolve(CursoRepository::class)->getByIdForEdit($_GET["id"]);
$instructores = App::resolve(InstructorRepository::class)->getAll();
$areas = App::resolve(AreaRepository::class)->getAll();

$curso["areas"] = explode(",", $curso["areas"]);
$curso["dias"] = explode(",", $curso["dias"]);

return view("admin/cursos/edit.view.php", [
    "title" => "Editar Servicio " . $curso["nombre"],
    "curso" => $curso,
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
