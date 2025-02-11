<?php

use Core\Session;

return view("/admin/personal/create.view.php", [
    "title" => "Nuevo Personal",
    "errors" => Session::get("errors"),
    "titulos" => [
        "Lic" => "Licenciado",
        "Ing" => "Ingeniero",
        "Mtro" => "Maestro",
        "Dr" => "Doctor"
    ]
]);
