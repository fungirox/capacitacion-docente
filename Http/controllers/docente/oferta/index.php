<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$allCursos = App::resolve(CursoRepository::class)->getAllUnsubscribed(Session::getUser("id"));

foreach ($allCursos as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $allCursos[$key]["areas"] = $areas;
}

return view("/docente/oferta/index.view.php", [
    "title" => "Oferta de Cursos",
    "allCursos" => $allCursos,
]);
