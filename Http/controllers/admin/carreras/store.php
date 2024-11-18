<?php

use Core\App;
use Core\Repositories\CarreraRepository;
use Http\Forms\CarreraForm;

CarreraForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"])),
]);

App::resolve(CarreraRepository::class)->create($attributes);

redirect("/admin/carreras");
