<?php

use Core\Roles\Roles;

const DOCENTE = Roles::DOCENTE;

# Inscritos

$router->get("/inscritos", "docente/inscritos/index.php")->only(DOCENTE);
$router->get("/inscritos/curso", "docente/inscritos/show.php")->only(DOCENTE);

# Oferta

$router->get("/oferta", "docente/oferta/index.php")->only(DOCENTE);
$router->get("/oferta/curso", "docente/oferta/show.php")->only(DOCENTE);

# Inscribirse Curso
$router->post("/oferta/registroDocenteCurso", "docente/oferta/registroDocenteCurso.php")->only(DOCENTE);