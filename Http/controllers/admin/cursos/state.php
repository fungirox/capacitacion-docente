<?php

use Core\App;
use Core\Repositories\ConstanciaRepository;
use Core\Repositories\CursoRepository;
use Core\Repositories\UsuarioRepository;

$newState = match ($_POST["state"]) {
    "privado" => "publico",
    "publico" => "en_progreso",
    "en_progreso" => "terminado",
    default => ""
};
$cursoId = $_POST["id"];
App::resolve(CursoRepository::class)->updateState($cursoId, $newState);
if ($newState == "terminado") {
    $usuarioId = App::resolve(UsuarioRepository::class)->getInstructorFullName($cursoId);
    App::resolve(ConstanciaRepository::class)->setConstancia($cursoId, $usuarioId["USERID"], 0);
    App::resolve(CursoRepository::class)->updatePersonal($cursoId, $_POST["personal"]);
}


redirect("/admin/cursos/curso?id=" . $cursoId);
