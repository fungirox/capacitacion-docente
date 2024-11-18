<?php

use Core\App;
use Core\Session;
use Core\Repositories\CarreraRepository;

$career = App::resolve(CarreraRepository::class)->getById($_GET["id"]);

return view("admin/carreras/edit.view.php", [
    "title" => "Editar Carrera " . $career["CARRERA_Siglas"],
    "career" => $career,
    "errors" => Session::get("errors")
]);
