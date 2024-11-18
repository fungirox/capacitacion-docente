<?php

use Core\App;
use Core\Database;
use Core\Session;

$area = App::resolve(Database::class)->query("SELECT * FROM tblArea WHERE AREAID = ?", [$_GET["id"]])->getOrFail();

return view("admin/areas/edit.view.php", [
    "title" => "Editar Área " . $area["AREA_Siglas"],
    "area" => $area,
    "errors" => Session::get("errors")
]);
