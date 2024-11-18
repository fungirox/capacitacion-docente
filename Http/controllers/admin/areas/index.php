<?php

use Core\App;
use Core\Database;

$allAreas = App::resolve(Database::class)->query("SELECT * FROM tblArea")->getAll();

return view("/admin/areas/index.view.php", [
    "title" => "Áreas",
    "allAreas" => $allAreas
]);
