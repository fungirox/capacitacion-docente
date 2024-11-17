<?php

use Core\Roles\Roles;

const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;

# Historial

$router->get("/historial", "controllers/docenteOrInstructor/historial/index.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso", "controllers/docenteOrInstructor/historial/evaluar.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso/F04PSA19", "controllers/docenteOrInstructor/encuestas/evaluar-F04PSA19.php")->only(DOCENTE_OR_INSTRUCTOR);
