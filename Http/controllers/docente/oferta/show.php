<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$curso = App::resolve(CursoRepository::class)->getUnsubscribedById($_GET["id"], Session::getUser("id"));

return view("docente/oferta/show.view.php", [
    "id" => $curso["id"],
    "nombre" => $curso["nombre"],
    "descripcion" => $curso["descripcion"],
    "tipo" => $curso["tipo"],
    "areas" => explode(",", $curso["areas"]),
    "duracion" => $curso["duracion"],
    "inicio" => formatDate($curso["inicio"]),
    "final" => formatDate($curso["final"]),
    "instructor" => $curso["instructor_nombre"]
]);
