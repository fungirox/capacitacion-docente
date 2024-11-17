<?php

use Core\Roles\Roles;

const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;

# Historial

$router->get("/historial", "docenteOrInstructor/historial/index.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso", "docenteOrInstructor/historial/evaluar.php")->only(DOCENTE_OR_INSTRUCTOR);
$router->post("/historial/evaluarCurso/F04PSA19", "docenteOrInstructor/encuestas/evaluar-F04PSA19.php")->only(DOCENTE_OR_INSTRUCTOR);
