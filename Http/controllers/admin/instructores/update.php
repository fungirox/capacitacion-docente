<?php

use Core\App;
use Core\Repositories\InstructorRepository;
use Http\Forms\InstructorForm;

InstructorForm::validate($attributes = [
    "edit" => true,
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "apellido" => trim($_POST["apellido"]),
    "username" => trim($_POST["username"]),
    "email" => trim($_POST["email"]),
    "genero" => $_POST["genero"],
    "estudios" => $_POST["estudios"],
    "updatePassword" => isset($_POST["update-password"]),
    "password" => trim($_POST["password"]),
    "confirmPassword" => trim($_POST["confirm-password"])
]);

App::resolve(InstructorRepository::class)->update($attributes);

redirect("/admin/instructores");
