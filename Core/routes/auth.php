<?php

use Core\Roles\Roles;

const GUEST = Roles::GUEST;
const ANY = Roles::ANY;

$router->get("/login", "controllers/auth/login.php")->only(GUEST);

$router->post("/login", "controllers/auth/authenticate.php")->only(GUEST);

$router->delete("/logout", "controllers/auth/logout.php")->only(ANY);
