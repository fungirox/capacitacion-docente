<?php

use Core\Session;

return view("admin/docentes/create.view.php", [
    "title" => "Registrar Docente",
    "errors" => Session::get("errors"),
    "nivelEstudios" => [
        "bachillerato" => "Bachillerato",
        "licenciatura" => "Licenciatura",
        "maestria" => "Maestría",
        "doctorado" => "Doctorado",
    ],
]);
