<?php

use Core\App;
use Core\Repositories\PersonalRepository;
use Http\Forms\PersonalForm;

PersonalForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "puesto" => trim($_POST["puesto"]),
    "titulo" => trim($_POST["titulo"])
]);

App::resolve(PersonalRepository::class)->update($attributes);

redirect("/admin/personal");
