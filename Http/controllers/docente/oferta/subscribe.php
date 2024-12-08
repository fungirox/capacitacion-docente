<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$cursoRepository = App::resolve(CursoRepository::class);

$attributes = [
    "cursoId" => $_POST["id"],
    "userId" => Session::getUser("id")
];

$inscrito = $cursoRepository->getSubscription($attributes["cursoId"], $attributes["userId"]);

if (!$inscrito) {
    $cursoRepository->subscribe($attributes["cursoId"], $attributes["userId"]);
}

redirect("/inscritos");
