<?php

use Core\App;
use Core\Repositories\DocenteRepository;
use Core\Session;

$docente = App::resolve(DocenteRepository::class)->getById($_GET["id"]);

return view("admin/docentes/edit.view.php", [
    "title" => "Editar Docentes '" . $docente["username"] . "'",
    "docente" => $docente,
    "errors" => Session::get("errors"),
    "nivelEstudios" => [
        "bachillerato" => "Bachillerato",
        "licenciatura" => "Licenciatura",
        "maestria" => "Maestría",
        "doctorado" => "Doctorado",
    ],
]);
