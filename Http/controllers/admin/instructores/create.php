<?php

use Core\Session;

return view("admin/instructores/create.view.php", [
    "title" => "Registrar Instructor",
    "errors" => Session::get("errors"),
    "nivelEstudios" => [
        "bachillerato" => "Bachillerato",
        "licenciatura" => "Licenciatura",
        "maestria" => "Maestría",
        "doctorado" => "Doctorado",
    ],
]);
