<?php

use Core\Session;

return view("admin/usuarios/create.view.php", [
    "title" => "Nuevo Usuario",
    "errors" => Session::get("errors")
]);
