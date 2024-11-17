<?php

use Core\Roles\Roles;

const GUEST = Roles::GUEST;
const ANY = Roles::ANY;

$router->get("/login", "auth/index.php")->only(GUEST);

$router->post("/login", "auth/store.php")->only(GUEST);

$router->delete("/logout", "auth/delete.php")->only(ANY);
