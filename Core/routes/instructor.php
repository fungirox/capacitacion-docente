<?php

use Core\Roles\Roles;

const INSTRUCTOR = Roles::INSTRUCTOR;

# Instruyendo

$router->get("/instruyendo", "/controllers/instructor/instruyendo/index.php")->only(INSTRUCTOR);
