<?php

use Core\App;
use Core\Repositories\AdministradorRepository;
use Http\Forms\AdministradorForm;

AdministradorForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "apellido" => trim($_POST["apellido"]),
    "username" => trim($_POST["username"]),
    "email" => trim($_POST["email"]),
    "genero" => $_POST["genero"],
    "password" => trim($_POST["password"]),
    "confirmPassword" => trim($_POST["confirm-password"])
]);

App::resolve(AdministradorRepository::class)->create($attributes);

redirect("/admin/administradores");
