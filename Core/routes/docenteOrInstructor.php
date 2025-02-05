<?php

use Core\Roles\Roles;

const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;

# Encuestas

$router->get("/historial", "docenteOrInstructor/encuestas/index.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/evaluarCurso", "docenteOrInstructor/encuestas/evaluar.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/evaluaciones/evaluarServicio", "docenteOrInstructor/encuestas/evaluar-servicio.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/evaluarEficacia", "docenteOrInstructor/encuestas/eficacia.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/evaluaciones/evaluarEficacia", "docenteOrInstructor/encuestas/evaluar-F08PSA19.00.php")->only(DOCENTE_OR_INSTRUCTOR);

# Constancias

$router->get("/constancias", "docenteOrInstructor/constancias/index.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/constanciaDocente", "docenteOrInstructor/constancias/constanciaDocente.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/constanciaInstructor", "docenteOrInstructor/constancias/constanciaInstructor.php")->only(DOCENTE_OR_INSTRUCTOR);