<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$cursoRepository = App::resolve(CursoRepository::class);

$inscrito = $cursoRepository->getSubscription($_POST["id"], Session::getUser("id"));

if ($inscrito) {
    $cursoRepository->unsubscribe($inscrito["CURSODOCENTEID"]);
}

redirect("/inscritos");
