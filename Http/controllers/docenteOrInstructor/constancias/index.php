<?php

use Core\App;
use Core\Session;
use Core\Repositories\ConstanciaRepository;

$usuarioId = Session::getUser("id");
$constanciasDocente = App::resolve(ConstanciaRepository::class)->getAllAsDocente($usuarioId);
$constanciasInstructor = App::resolve(ConstanciaRepository::class)->getAllAsInstructor($usuarioId);

return view("/docenteOrInstructor/constancias/index.view.php", [
    "title" => "Constancias",
    "constanciasDocente" => $constanciasDocente,
    "constanciasInstructor" => $constanciasInstructor
]);
