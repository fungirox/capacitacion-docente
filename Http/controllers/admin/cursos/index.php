<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$allCourses = $db->query("SELECT * FROM tblCurso")->getAll();

return view("admin/cursos/index.view.php", [
    "title" => "Cursos",
    "allCourses" => $allCourses,
    "db" => $db
]
);
