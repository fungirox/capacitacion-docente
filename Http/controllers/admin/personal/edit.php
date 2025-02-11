<?php

use Core\App;
use Core\Repositories\PersonalRepository;
use Core\Session;

$personal = App::resolve(PersonalRepository::class)->getByIdForEdit($_GET["id"]);

return view("admin/personal/edit.view.php", [
    "title" => "Editar Personal " . $personal["nombre"],
    "personal" => $personal,
    "errors" => Session::get("errors"),
    "titulos" => [
        "Lic" => "Licenciado",
        "Ing" => "Ingeniero",
        "Mtro" => "Maestro",
        "Dr" => "Doctor"
    ]
]);
