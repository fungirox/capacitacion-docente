<?php

use Core\App;
use Core\Repositories\CarreraRepository;
use Http\Forms\CarreraForm;

CarreraForm::validate($attributes = [
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"])),
]);

App::resolve(CarreraRepository::class)->update($attributes);

redirect("/admin/carreras");
