<?php

use Core\Roles\Roles;

const GUEST = Roles::GUEST;
const ANY = Roles::ANY;

$router->get("/login", "controllers/auth/index.php")->only(GUEST);

$router->post("/login", "controllers/auth/store.php")->only(GUEST);

$router->delete("/logout", "controllers/auth/delete.php")->only(ANY);
