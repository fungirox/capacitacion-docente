<?php

use Core\App;
use Core\Repositories\InstructorRepository;
use Core\Session;

$instructor = App::resolve(InstructorRepository::class)->getById($_GET["id"]);

return view("admin/instructores/edit.view.php", [
    "title" => "Editar Instructor '" . $instructor["username"] . "'",
    "instructor" => $instructor,
    "errors" => Session::get("errors"),
    "nivelEstudios" => [
        "bachillerato" => "Bachillerato",
        "licenciatura" => "Licenciatura",
        "maestria" => "Maestría",
        "doctorado" => "Doctorado",
    ],
]);
