<?php

use Core\Session;

return view("admin/carreras/create.view.php", [
    "title" => "Nueva Carrera",
    "errors" => Session::get("errors")
]);
