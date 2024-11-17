<?php

use Core\App;
use Core\Database;
use Core\Session;

$career = App::resolve(Database::class)->query("SELECT * FROM tblCarrera WHERE CARRERAID = ?", [$_GET["id"]])->getOrFail();

return view("admin/carreras/edit.view.php", [
    "title" => "Editar Carrera " . $career["CARRERA_Siglas"],
    "career" => $career,
    "errors" => Session::get("errors")
]);
