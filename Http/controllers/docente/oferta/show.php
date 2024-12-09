<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$curso = App::resolve(CursoRepository::class)->getUnsubscribedById($_GET["id"], Session::getUser("id"));

return view("docente/oferta/show.view.php", [
    "id" => htmlspecialchars($curso["id"]),
    "nombre" => htmlspecialchars($curso["nombre"]),
    "descripcion" => htmlspecialchars($curso["descripcion"]),
    "tipo" => htmlspecialchars(ucfirst($curso["tipo"])),
    "isVirtual" => htmlspecialchars($curso["modalidad"] == "virtual"),
    "areas" => explode(",", htmlspecialchars($curso["areas"])),
    "duracion" => htmlspecialchars($curso["duracion"]),
    "fechas" => htmlspecialchars(formattedDateRange(formatDate($curso["inicio"]), formatDate($curso["final"]))),
    "dias" => htmlspecialchars(fullFormattedDays($curso["dias"])),
    "horas" => htmlspecialchars(formattedHourRange($curso["hora_inicial"], $curso["hora_final"])),
    "aula" => htmlspecialchars($curso["aula"]),
    "instructor" => htmlspecialchars($curso["instructor_nombre"])
]);
