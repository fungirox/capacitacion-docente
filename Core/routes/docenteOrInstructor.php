<?php

use Core\Roles\Roles;

const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;

# Historial

$router->get("/historial", "docenteOrInstructor/historial/index.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/evaluarCurso", "docenteOrInstructor/historial/evaluar.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/evaluarEficacia", "docenteOrInstructor/historial/eficacia.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->get("/historial/constanciaDocente", "docenteOrInstructor/historial/constanciaDocente.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso/F04PSA19", "docenteOrInstructor/encuestas/evaluar-F04PSA19.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso/F10PSA19.00", "docenteOrInstructor/encuestas/evaluar-F10PSA19.00.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso/F08PSA19.00", "docenteOrInstructor/encuestas/evaluar-F08PSA19.00.php")->only(DOCENTE_OR_INSTRUCTOR);
