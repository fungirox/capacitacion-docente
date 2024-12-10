<?php

use Core\Roles\Roles;

const INSTRUCTOR = Roles::INSTRUCTOR;

# Instruyendo

$router->get("/instruyendo", "instructor/instruyendo/index.php")->only(INSTRUCTOR);
