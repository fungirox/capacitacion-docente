<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

return view("/docente/oferta/index.view.php", [
    "title" => "Oferta",
    "allCourses" => $allCourses,
    "db" => $db
]
);
