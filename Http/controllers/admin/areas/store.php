<?php

use Core\App;
use Core\Database;
use Http\Forms\AreaForm;

AreaForm::validate($attribuutes = [
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"]))
]);

App::resolve(Database::class)->query(
    "INSERT INTO tblArea (AREA_Nombre, AREA_Siglas) VALUES (?, ?)",
    [$attribuutes["nombre"], $attribuutes["siglas"]]
);

redirect("/admin/areas");
