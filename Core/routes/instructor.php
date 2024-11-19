<?php

use Core\Roles\Roles;

const INSTRUCTOR = Roles::INSTRUCTOR;

# Instruyendo

$router->get("/instruyendo", "/controllers/instructor/instruyendo/index.php")->only(INSTRUCTOR);

# Inscritos

$router->get("/inscritos", "docente/inscritos/index.php")->only(DOCENTE);

# Oferta

$router->get("/oferta", "docente/oferta/index.php")->only(DOCENTE);
$router->get("/oferta/curso", "docente/oferta/show.php")->only(DOCENTE);

# Inscribirse Curso
$router->post("/oferta/registroDocenteCurso", "docente/oferta/registroDocenteCurso.php")->only(DOCENTE);