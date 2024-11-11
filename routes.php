<?php

use Core\Roles\Roles;

const GUEST = Roles::GUEST;
const ADMIN = Roles::ADMIN;
const DOCENTE = Roles::DOCENTE;
const INSTRUCTOR = Roles::INSTRUCTOR;
Const DOCENTE_OR_INSTRUCTOR = Roles::DOCENTE_OR_INSTRUCTOR;
const ANY = Roles::ANY;

## Auth

$router->get("/login", "controllers/auth/login.php")->only(GUEST);

$router->post("/login", "controllers/auth/authenticate.php")->only(GUEST);

$router->get("/logout", "controllers/auth/logout.php")->only(ANY);
$router->delete("/logout", "controllers/auth/logout.php")->only(ANY);

## Docente

# Inscritos

$router->get("/inscritos", "controllers/docente/inscritos/index.php")->only(DOCENTE);

# Oferta

$router->get("/oferta", "controllers/docente/oferta/index.php")->only(DOCENTE);

## Instructor

# Instruyendo

$router->get("/instruyendo", "/controllers/instructor/instruyendo/index.php")->only(INSTRUCTOR);

## Administrador

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
