<?php

use Core\Roles\Roles;

const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;

# Historial

$router->get("/historial", "controllers/docenteOrInstructor/historial/index.php")->only(DOCENTE_OR_INSTRUCTOR);
