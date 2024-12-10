<?php

use Core\Roles\Roles;

const DOCENTE = Roles::DOCENTE;

# Inscritos

$router->get("/inscritos", "docente/inscritos/index.php")->only(DOCENTE);
$router->get("/inscritos/curso", "docente/inscritos/show.php")->only(DOCENTE);

$router->delete("/inscritos/curso", "docente/inscritos/unsubscribe.php")->only(DOCENTE);

# Oferta

$router->get("/oferta", "docente/oferta/index.php")->only(DOCENTE);
$router->get("/oferta/curso", "docente/oferta/show.php")->only(DOCENTE);

$router->post("/oferta/curso", "docente/oferta/subscribe.php")->only(DOCENTE);

# Constancias

$router->get("/constancias", "docente/constancias/index.php")->only(DOCENTE);
