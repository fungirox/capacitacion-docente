<?php

use Core\App;
use Core\Database;
use Http\Forms\CarreraForm;

CarreraForm::validate($attributes = [
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"])),
]);

App::resolve(Database::class)->query(
    "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
    [$attributes["nombre"], $attributes["siglas"]]
);

redirect("/admin/carreras");
