<?php

use Core\Roles\Roles;

const DOCENTE = Roles::DOCENTE;

# Inscritos

$router->get("/inscritos", "controllers/docente/inscritos/index.php")->only(DOCENTE);

# Oferta

$router->get("/oferta", "controllers/docente/oferta/index.php")->only(DOCENTE);
