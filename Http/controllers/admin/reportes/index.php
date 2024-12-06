<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

return view("/admin/reportes/index.view.php", [
    "title" => "Reportes",
    "cursosConcluidos" => App::resolve(CursoRepository::class)->getCursosConcluidosAdmin(),
    "cursosSinEficacia" => App::resolve(CursoRepository::class)->getCursosSinEficaciaAdmin()
]);
