<?php

use Core\Session;

return view("/admin/areas/create.view.php", [
    "title" => "Nueva Área",
    "errors" => Session::get("errors")
]);
