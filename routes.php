<?php

# Auth

$router->get("/login", "controllers/auth/login.php")->only("guest");

$router->post("/login", "controllers/auth/authenticate.php")->only("guest");

$router->delete("/logout", "controllers/auth/logout.php")->only("admins");

# Docentes

$router->get("/oferta", "controllers/docentes/oferta/index.php")->only("docente");

# Administradores

# Cursos

$router->get("/admin/cursos", "controllers/admin/cursos/index.php")->only("admins");
$router->get("/admin/curso", "controllers/admin/cursos/show.php")->only("admins");
$router->get("/admin/cursos/nuevo", "controllers/admin/cursos/create.php")->only("admins");

# Usuarios

$router->get("/admin/usuarios", "controllers/admin/usuarios/index.php")->only("admins");
$router->get("/admin/usuarios/nuevo", "controllers/admin/usuarios/create.php")->only("admins");

$router->post("/admin/usuarios", "controllers/admin/usuarios/store.php")->only("admins");

# Áreas

$router->get("/admin/areas", "controllers/admin/areas/index.php")->only("admins");
$router->get("/admin/areas/editar", "controllers/admin/areas/edit.php")->only("admins");
$router->get("/admin/areas/nuevo", "controllers/admin/areas/create.php")->only("admins");

$router->post("/admin/areas", "controllers/admin/areas/store.php")->only("admins");

$router->delete("/admin/areas", "controllers/admin/areas/destroy.php")->only("admins");

$router->patch("/admin/areas", "controllers/admin/areas/update.php")->only("admins");

# Carreras

$router->get("/admin/carreras", "controllers/admin/carreras/index.php")->only("admins");
$router->get("/admin/carreras/editar", "controllers/admin/carreras/edit.php")->only("admins");
$router->get("/admin/carreras/nuevo", "controllers/admin/carreras/create.php")->only("admins");

$router->post("/admin/carreras", "controllers/admin/carreras/store.php")->only("admins");

$router->delete("/admin/carreras", "controllers/admin/carreras/destroy.php")->only("admins");

$router->patch("/admin/carreras", "controllers/admin/carreras/update.php")->only("admins");
