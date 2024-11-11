<?php

use Core\Roles\Roles;

const ADMIN = Roles::ADMIN;

# Cursos

$router->get("/admin/cursos", "controllers/admin/cursos/index.php")->only(ADMIN);
$router->get("/admin/curso", "controllers/admin/cursos/show.php")->only(ADMIN);
$router->get("/admin/cursos/nuevo", "controllers/admin/cursos/create.php")->only(ADMIN);

$router->post("/admin/cursos", "controllers/admin/cursos/store.php")->only(ADMIN);

$router->delete("/admin/cursos", "controllers/admin/cursos/destroy.php")->only(ADMIN);

$router->patch("/admin/cursos", "controllers/admin/cursos/update.php")->only(ADMIN);

# Usuarios

$router->get("/admin/usuarios", "controllers/admin/usuarios/index.php")->only(ADMIN);
$router->get("/admin/usuarios/nuevo", "controllers/admin/usuarios/create.php")->only(ADMIN);

$router->post("/admin/usuarios", "controllers/admin/usuarios/store.php")->only(ADMIN);

# Áreas

$router->get("/admin/areas", "controllers/admin/areas/index.php")->only(ADMIN);
$router->get("/admin/areas/editar", "controllers/admin/areas/edit.php")->only(ADMIN);
$router->get("/admin/areas/nuevo", "controllers/admin/areas/create.php")->only(ADMIN);

$router->post("/admin/areas", "controllers/admin/areas/store.php")->only(ADMIN);

$router->delete("/admin/areas", "controllers/admin/areas/destroy.php")->only(ADMIN);

$router->patch("/admin/areas", "controllers/admin/areas/update.php")->only(ADMIN);

# Carreras

$router->get("/admin/carreras", "controllers/admin/carreras/index.php")->only(ADMIN);
$router->get("/admin/carreras/editar", "controllers/admin/carreras/edit.php")->only(ADMIN);
$router->get("/admin/carreras/nuevo", "controllers/admin/carreras/create.php")->only(ADMIN);

$router->post("/admin/carreras", "controllers/admin/carreras/store.php")->only(ADMIN);

$router->delete("/admin/carreras", "controllers/admin/carreras/destroy.php")->only(ADMIN);

$router->patch("/admin/carreras", "controllers/admin/carreras/update.php")->only(ADMIN);
