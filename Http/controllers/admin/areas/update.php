<?php

use Core\App;
use Core\Database;
use Http\Forms\AreaForm;

AreaForm::validate($attribuutes = [
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"]))
]);

App::resolve(Database::class)->query(
    "UPDATE tblArea SET AREA_Nombre = ?, AREA_Siglas = ? WHERE AREAID = ?",
    [$attribuutes["nombre"], $attribuutes["siglas"], $attribuutes["id"]]
);

redirect("/admin/areas");
