<?php

use Core\App;
use Core\Repositories\CursoRepository;

$curso = App::resolve(CursoRepository::class)->getById($_GET["id"]);

return view("admin/cursos/show.view.php", [
    "id" => $curso["id"],
    "nombre" => $curso["nombre"],
    "descripcion" => $curso["descripcion"],
    "tipo" => $curso["tipo"],
    "areas" => explode(",", $curso["areas"]),
    "duracion" => $curso["duracion"],
    "inicio" => formatDate($curso["inicio"]),
    "final" => formatDate($curso["final"]),
    "instructor" => $curso["instructor"]
]);
