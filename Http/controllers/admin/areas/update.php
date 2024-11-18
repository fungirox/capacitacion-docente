<?php

use Core\App;
use Core\Repositories\AreaRepository;
use Http\Forms\AreaForm;

AreaForm::validate($attributes = [
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"]))
]);

App::resolve(AreaRepository::class)->update($attributes);

redirect("/admin/areas");
