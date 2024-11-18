<?php

use Core\App;
use Core\Repositories\UsuarioRepository;
use Core\Session;

$usuario = App::resolve(UsuarioRepository::class)->getById($_GET["id"]);

return view("admin/usuarios/edit.view.php", [
    "title" => "Editar Usuario " . $usuario["USER_NombreUsuario"],
    "usuario" => $usuario,
    "errors" => Session::get("errors")
]);
