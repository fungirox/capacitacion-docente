<?php

use Core\Roles\Roles;

const ADMIN = Roles::ADMIN;

# Cursos

$router->get("/admin/cursos", "admin/cursos/index.php")->only(ADMIN);
$router->get("/admin/curso", "admin/cursos/show.php")->only(ADMIN);
$router->get("/admin/cursos/nuevo", "admin/cursos/create.php")->only(ADMIN);

$router->post("/admin/cursos", "admin/cursos/store.php")->only(ADMIN);

$router->delete("/admin/cursos", "admin/cursos/destroy.php")->only(ADMIN);

$router->patch("/admin/cursos", "admin/cursos/update.php")->only(ADMIN);

# Usuarios

$router->get("/admin/usuarios", "admin/usuarios/index.php")->only(ADMIN);
$router->get("/admin/usuarios/editar", "admin/usuarios/edit.php")->only(ADMIN);
$router->get("/admin/usuarios/nuevo", "admin/usuarios/create.php")->only(ADMIN);

$router->post("/admin/usuarios", "admin/usuarios/store.php")->only(ADMIN);

$router->delete("/admin/usuarios", "admin/usuarios/destroy.php")->only(ADMIN);

# Áreas

$router->get("/admin/areas", "admin/areas/index.php")->only(ADMIN);
$router->get("/admin/areas/editar", "admin/areas/edit.php")->only(ADMIN);
$router->get("/admin/areas/nuevo", "admin/areas/create.php")->only(ADMIN);

$router->post("/admin/areas", "admin/areas/store.php")->only(ADMIN);

$router->delete("/admin/areas", "admin/areas/destroy.php")->only(ADMIN);

$router->patch("/admin/areas", "admin/areas/update.php")->only(ADMIN);

# Carreras

$router->get("/admin/carreras", "admin/carreras/index.php")->only(ADMIN);
$router->get("/admin/carreras/editar", "admin/carreras/edit.php")->only(ADMIN);
$router->get("/admin/carreras/nuevo", "admin/carreras/create.php")->only(ADMIN);

$router->post("/admin/carreras", "admin/carreras/store.php")->only(ADMIN);

$router->delete("/admin/carreras", "admin/carreras/destroy.php")->only(ADMIN);

$router->patch("/admin/carreras", "admin/carreras/update.php")->only(ADMIN);
