<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$allCursos = App::resolve(CursoRepository::class)->getAllSubscribed(Session::getUser("id"));

foreach ($allCursos as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $allCursos[$key]["areas"] = $areas;
}

return view("/docente/inscritos/index.view.php", [
    "title" => "Cursos Inscritos",
    "allCursos" => $allCursos,
]);
