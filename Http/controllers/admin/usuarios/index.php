<?php

use Core\App;
use Core\Repositories\UsuarioRepository;

return view("admin/usuarios/index.view.php", [
    "title" => "Usuarios",
    "allUsers" => App::resolve(UsuarioRepository::class)->getAllExceptCurrent()
]);
