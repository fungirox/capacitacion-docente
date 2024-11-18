<?php

use Core\App;
use Core\Database;
use Core\Repositories\AreaRepository;
use Core\Session;

$area = App::resolve(AreaRepository::class)->getById($_GET["id"]);

return view("admin/areas/edit.view.php", [
    "title" => "Editar Área " . $area["AREA_Siglas"],
    "area" => $area,
    "errors" => Session::get("errors")
]);
