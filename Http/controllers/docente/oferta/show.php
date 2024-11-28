<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$curso = App::resolve(CursoRepository::class)->getUnsubscribedById($_GET["id"], Session::getUser("id"));

return view("docente/oferta/show.view.php", [
    "id" => htmlspecialchars($curso["id"]),
    "nombre" => htmlspecialchars($curso["nombre"]),
    "descripcion" => htmlspecialchars($curso["descripcion"]),
    "tipo" => htmlspecialchars($curso["tipo"]),
    "areas" => explode(",", htmlspecialchars($curso["areas"])),
    "duracion" => htmlspecialchars($curso["duracion"]),
    "inicio" => formatDate(htmlspecialchars($curso["inicio"])),
    "final" => formatDate(htmlspecialchars($curso["final"])),
    "aula" => htmlspecialchars($curso["aula"]),
    "instructor" => htmlspecialchars($curso["instructor_nombre"])
]);
