<?php

use Core\Roles\Roles;

const INSTRUCTOR = Roles::INSTRUCTOR;

# Instruyendo

$router->get("/instruyendo", "instructor/instruyendo/index.php")->only(INSTRUCTOR);
$router->get("/instruyendo/curso", "instructor/instruyendo/show.php")->only(INSTRUCTOR);

# Asistencia

$router->get("/instruyendo/curso/asistencia", "instructor/instruyendo/asistencia/index.php")->only(INSTRUCTOR);
