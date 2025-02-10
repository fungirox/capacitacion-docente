<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$now = new DateTime();
$year = $now -> format("Y");

return view("/admin/formatos/index.view.php", [
    "title" => "Formatos",
    "year" => $year
]);
