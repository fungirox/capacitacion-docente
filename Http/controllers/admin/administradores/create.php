<?php

use Core\Session;

return view("admin/administradores/create.view.php", [
    "title" => "Registrar Administrador",
    "errors" => Session::get("errors"),
]);
