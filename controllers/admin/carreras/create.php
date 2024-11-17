<?php

use Core\Session;

$title = "Nueva Carrera";

return view("admin/carreras/create.view.php", [
    "errors" => Session::get("errors")
]);
