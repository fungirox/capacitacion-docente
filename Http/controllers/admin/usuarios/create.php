<?php

use Core\Session;

require view("admin/usuarios/create.view.php", [
    "title" => "Nuevo Usuario",
    "errors" => Session::get("errors")
]);
