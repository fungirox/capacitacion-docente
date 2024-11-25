<?php

use Core\App;
use Core\Repositories\CursoRepository;

return view("admin/cursos/index.view.php", [
    "title" => "Cursos",
    "allCourses" => App::resolve(CursoRepository::class)->getAll()
]);
