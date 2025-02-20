<?php

use Core\App;
use Core\Repositories\AreaRepository;
use Http\Forms\AreaForm;

AreaForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"])),
    "tipo" => $_POST["tipo"]
]);

App::resolve(AreaRepository::class)->create($attributes);

redirect("/admin/areas");
