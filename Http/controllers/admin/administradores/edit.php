<?php

use Core\App;
use Core\Repositories\AdministradorRepository;
use Core\Session;

$administrador = App::resolve(AdministradorRepository::class)->getById($_GET["id"]);

return view("admin/administradores/edit.view.php", [
    "title" => "Editar Administrador '" . $administrador["username"] . "'",
    "administrador" => $administrador,
    "errors" => Session::get("errors"),
]);
