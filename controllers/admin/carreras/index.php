<?php

use Core\App;
use Core\Database;

$allCareers = App::resolve(Database::class)->query("SELECT * FROM tblCarrera")->getAll();

return view("admin/carreras/index.view.php", [
    "title" => "Carreras",
    "allCareers" => $allCareers
]);
