<?php

use Core\App;
use Core\Repositories\CursoRepository;

$allCursos = App::resolve(CursoRepository::class)->getAll();

foreach ($allCursos as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $allCursos[$key]["areas"] = $areas;
}

return view("admin/cursos/index.view.php", [
    "title" => "Cursos",
    "allCourses" => $allCursos
]);
