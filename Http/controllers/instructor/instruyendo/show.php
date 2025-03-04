<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$curso = App::resolve(CursoRepository::class)->getAllTeachingById($_GET["id"], Session::getUser("id"));

return view("components/curso.php", [
    "root" => "/instruyendo",
    "id" => htmlspecialchars($curso["id"]),
    "nombre" => htmlspecialchars($curso["nombre"]),
    "descripcion" => htmlspecialchars($curso["descripcion"]),
    "tipo" => htmlspecialchars(ucfirst($curso["tipo"])),
    "isVirtual" => htmlspecialchars($curso["modalidad"] == "virtual"),
    "areas" => explode(",", htmlspecialchars($curso["areas"])),
    "origen" => htmlspecialchars($curso["origen"]),
    "perfil" => htmlspecialchars($curso["perfil"]),
    "duracion" => htmlspecialchars($curso["duracion"]),
    "fechas" => htmlspecialchars(formattedDateRange(formatDate($curso["inicio"]), formatDate($curso["final"]))),
    "dias" => htmlspecialchars(fullFormattedDays($curso["dias"])),
    "horas" => htmlspecialchars(formattedHourRange($curso["hora_inicial"], $curso["hora_final"])),
    "aula" => htmlspecialchars($curso["aula"]),
    "limite" => htmlspecialchars($curso["limite"]),
    "disponibles" => htmlspecialchars($curso["disponibles"]),
    "instructor" => htmlspecialchars($curso["instructor_nombre"]),
    "cantiadadSesiones" => htmlspecialchars($curso["cantidad_sesiones"] + 1) ?? 1,
    "mode" => "instruyendo"
]);
