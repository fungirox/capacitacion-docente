<?php

use Core\App;
use Core\Database;
use Http\Forms\CarreraForm;

CarreraForm::validate($attributes = [
    "id" => $_POST["id"],
    "nombre" => trim($_POST["nombre"]),
    "siglas" => strtoupper(trim($_POST["siglas"])),
]);

App::resolve(Database::class)->query(
    "UPDATE tblCarrera SET CARRERA_Nombre = ?, CARRERA_Siglas = ? WHERE CARRERAID = ?",
    [$attributes["nombre"], $attributes["siglas"], $attributes["id"]]
);

redirect("/admin/carreras");
