<?php

use Core\App;
use Core\Repositories\CursoRepository;

$curso = App::resolve(CursoRepository::class)->getById($_GET["id"]);

$estado = match ($curso["estado"]) {
    "publico" => "público",
    "en_progreso" => "en progreso",
    default => $curso["estado"]
};

return view("components/curso.php", [
    "root" => "/admin/cursos",
    "id" => htmlspecialchars($curso["id"]),
    "nombre" => htmlspecialchars($curso["nombre"]),
    "descripcion" => htmlspecialchars($curso["descripcion"]),
    "tipo" => htmlspecialchars(ucfirst($curso["tipo"])),
    "isVirtual" => htmlspecialchars($curso["modalidad"] == "virtual"),
    "estado" => htmlspecialchars($estado),
    "areas" => explode(",", htmlspecialchars($curso["areas"])),
    "origen" => htmlspecialchars($curso["origen"]),
    "perfil" => htmlspecialchars($curso["perfil"]),
    "duracion" => htmlspecialchars($curso["duracion"]),
    "fechas" => htmlspecialchars(formattedDateRange(formatDate($curso["inicio"]), formatDate($curso["final"]))),
    "dias" => htmlspecialchars(fullFormattedDays($curso["dias"])),
    "horas" => htmlspecialchars(formattedHourRange($curso["hora_inicial"], $curso["hora_final"])),
    "aula" => htmlspecialchars($curso["aula"]),
    "limite" => htmlspecialchars($curso["limite"]),
    "instructor" => htmlspecialchars($curso["instructor_nombre"]),
    "mode" => "admin"
]);
