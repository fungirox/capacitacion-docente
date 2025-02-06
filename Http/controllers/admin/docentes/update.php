<?php

use Core\App;
use Core\Repositories\DocenteRepository;
use Http\Forms\DocenteForm;

DocenteForm::validate($attributes = [
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
    "confirmPassword" => trim($_POST["confirm-password"]),
    "baseHoras" => $_POST["base-horas"] ?? 0,
    "horasBase" => $_POST["horas-base"] ?? 0,
    "docenteInstructor" => $_POST["docente-instructor"] ?? 0,
    "isDocenteInstructor" => $_POST["is-docente-instructor"]
]);

App::resolve(DocenteRepository::class)->update($attributes);

redirect("/admin/docentes");
