<?php

use Core\App;
use Core\Repositories\ConstanciaRepository;
use Core\Repositories\CursoRepository;
use Core\Repositories\UsuarioRepository;

$newState = match ($_POST["state"]) {
    "privado" => "publico",
    "publico" => "en_progreso",
    "en_progreso" => "terminado",
};

App::resolve(CursoRepository::class)->updateState($_POST["id"], $newState);
$usuarioId = App::resolve(UsuarioRepository::class)->getInstructorFullName($_POST["id"]);
if($newState == "terminado"){
    App::resolve(ConstanciaRepository::class)->setConstancia($_POST["id"],$usuarioId["USERID"],1);
    App::resolve(CursoRepository::class)->updatePersonal($_POST["id"],$_POST["personal"]);
}

redirect("/admin/cursos/curso?id=" . $_POST["id"]);
