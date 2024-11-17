<?php

use Core\Session;

return view("auth/index.view.php", [
    "title" => "Iniciar Sesión",
    "errors" => Session::get("errors")
]);
