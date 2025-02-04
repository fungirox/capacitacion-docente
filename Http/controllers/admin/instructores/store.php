<?php

use Core\App;
use Core\Repositories\InstructorRepository;
use Http\Forms\InstructorForm;

InstructorForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "apellido" => trim($_POST["apellido"]),
    "username" => trim($_POST["username"]),
    "email" => trim($_POST["email"]),
    "genero" => $_POST["genero"],
    "estudios" => $_POST["estudios"],
    "password" => trim($_POST["password"]),
    "confirmPassword" => trim($_POST["confirm-password"])
]);

App::resolve(InstructorRepository::class)->create($attributes);

redirect("/admin/instructores?sortBy=usuario.USERID-DESC");
