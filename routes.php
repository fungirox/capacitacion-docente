<?php

## Auth

$router->get("/login", "controllers/auth/login.php")->only("guest");

$router->post("/login", "controllers/auth/authenticate.php")->only("guest");

$router->delete("/logout", "controllers/auth/logout.php")->only("admin");

## Docente

# Inscritos

$router->get("/inscritos", "controllers/docente/inscritos/index.php")->only("docente");

# Oferta

$router->get("/oferta", "controllers/docente/oferta/index.php")->only("docente");

## Inscritos

$router->get("/instruyendo", "");

## Administrador

# Cursos

$router->get("/admin/cursos", "controllers/admin/cursos/index.php")->only("admin");
$router->get("/admin/curso", "controllers/admin/cursos/show.php")->only("admin");
$router->get("/admin/cursos/nuevo", "controllers/admin/cursos/create.php")->only("admin");

$router->post("/admin/cursos", "controllers/admin/cursos/store.php")->only("admin");

$router->delete("/admin/cursos", "controllers/admin/cursos/destroy.php")->only("admin");

$router->patch("/admin/cursos", "controllers/admin/cursos/update.php")->only("admin");

# Usuarios

$router->get("/admin/usuarios", "controllers/admin/usuarios/index.php")->only("admin");
$router->get("/admin/usuarios/nuevo", "controllers/admin/usuarios/create.php")->only("admin");

$router->post("/admin/usuarios", "controllers/admin/usuarios/store.php")->only("admin");

# Áreas

$router->get("/admin/areas", "controllers/admin/areas/index.php")->only("admin");
$router->get("/admin/areas/editar", "controllers/admin/areas/edit.php")->only("admin");
$router->get("/admin/areas/nuevo", "controllers/admin/areas/create.php")->only("admin");

$router->post("/admin/areas", "controllers/admin/areas/store.php")->only("admin");

$router->delete("/admin/areas", "controllers/admin/areas/destroy.php")->only("admin");

$router->patch("/admin/areas", "controllers/admin/areas/update.php")->only("admin");

# Carreras

$router->get("/admin/carreras", "controllers/admin/carreras/index.php")->only("admin");
$router->get("/admin/carreras/editar", "controllers/admin/carreras/edit.php")->only("admin");
$router->get("/admin/carreras/nuevo", "controllers/admin/carreras/create.php")->only("admin");

$router->post("/admin/carreras", "controllers/admin/carreras/store.php")->only("admin");

$router->delete("/admin/carreras", "controllers/admin/carreras/destroy.php")->only("admin");

$router->patch("/admin/carreras", "controllers/admin/carreras/update.php")->only("admin");
