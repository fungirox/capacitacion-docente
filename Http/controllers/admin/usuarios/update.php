<?php

use Core\App;
use Core\Repositories\UsuarioRepository;
use Http\Forms\CarreraForm;

CarreraForm::validate($attributes = [
    "rol" => $_POST["rol"],
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "apellido" => trim($_POST["apellido"]),
    "email" => trim($_POST["email"]),
    "baseOrHoras" => $_POST["base-horas"],
    "horasBase" => $_POST["horas-base"],
    "isDocenteInstructor" => isset($_POST["docente-instructor"]) ? $_POST["docente-instructor"] : "0",
]);

App::resolve(UsuarioRepository::class)->update($attributes);

redirect("/admin/usuarios");
