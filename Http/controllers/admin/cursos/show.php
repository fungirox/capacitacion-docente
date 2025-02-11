<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Repositories\PersonalRepository;

$curso = App::resolve(CursoRepository::class)->getById($_GET["id"]);
$personal = App::resolve(PersonalRepository::class)->getAll();

$formattedState = match ($curso["estado"]) {
    "privado" => "privado",
    "publico" => "público",
    "en_progreso" => "en progreso",
    "terminado" => "terminado",
};

$action = match ($curso["estado"]) {
    "privado" => "Publicar curso",
    "publico" => "Comenzar curso",
    "en_progreso" => "Finalizar curso",
    "terminado" => "",
};

return view("components/curso.php", [
    "root" => "/admin/cursos",
    "personal" => $personal,
    "action" => $action,
    "id" => htmlspecialchars($curso["id"]),
    "nombre" => htmlspecialchars($curso["nombre"]),
    "descripcion" => htmlspecialchars($curso["descripcion"]),
    "tipo" => htmlspecialchars(ucfirst($curso["tipo"])),
    "isVirtual" => htmlspecialchars($curso["modalidad"] == "virtual"),
    "estado" => htmlspecialchars($curso["estado"]),
    "archivado" => htmlspecialchars($curso["archivado"]),
    "formattedState" => htmlspecialchars($formattedState),
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
    "mode" => "admin"
]);
