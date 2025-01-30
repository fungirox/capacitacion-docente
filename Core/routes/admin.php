<?php

use Core\Roles\Roles;

const ADMIN = Roles::ADMIN;

# Cursos

$router->get("/admin/cursos", "admin/cursos/index.php")->only(ADMIN);
$router->get("/admin/cursos/curso", "admin/cursos/show.php")->only(ADMIN);
$router->get("/admin/cursos/editar", "admin/cursos/edit.php")->only(ADMIN);
$router->get("/admin/cursos/nuevo", "admin/cursos/create.php")->only(ADMIN);

$router->post("/admin/cursos", "admin/cursos/store.php")->only(ADMIN);

$router->delete("/admin/cursos", "admin/cursos/archive.php")->only(ADMIN);

$router->patch("/admin/cursos", "admin/cursos/update.php")->only(ADMIN);

## Usuarios

# Administradores

$router->get("/admin/administradores", "admin/administradores/index.php")->only(ADMIN);
$router->get("/admin/administradores/editar", "admin/administradores/edit.php")->only(ADMIN);
$router->get("/admin/administradores/nuevo", "admin/administradores/create.php")->only(ADMIN);

$router->post("/admin/administradores", "admin/administradores/store.php")->only(ADMIN);

$router->delete("/admin/administradores", "admin/administradores/archive.php")->only(ADMIN);

$router->patch("/admin/administradores", "admin/administradores/update.php")->only(ADMIN);

# Usuarios

$router->get("/admin/usuarios", "admin/usuarios/index.php")->only(ADMIN);
$router->get("/admin/usuarios/editar", "admin/usuarios/edit.php")->only(ADMIN);
$router->get("/admin/usuarios/nuevo", "admin/usuarios/create.php")->only(ADMIN);

$router->post("/admin/usuarios", "admin/usuarios/store.php")->only(ADMIN);

$router->delete("/admin/usuarios", "admin/usuarios/destroy.php")->only(ADMIN);

$router->patch("/admin/usuarios", "admin/usuarios/update.php")->only(ADMIN);

# Áreas

$router->get("/admin/areas", "admin/areas/index.php")->only(ADMIN);
$router->get("/admin/areas/editar", "admin/areas/edit.php")->only(ADMIN);
$router->get("/admin/areas/nuevo", "admin/areas/create.php")->only(ADMIN);

$router->post("/admin/areas", "admin/areas/store.php")->only(ADMIN);

$router->delete("/admin/areas", "admin/areas/archive.php")->only(ADMIN);

$router->patch("/admin/areas", "admin/areas/update.php")->only(ADMIN);

# Carreras

$router->get("/admin/carreras", "admin/carreras/index.php")->only(ADMIN);
$router->get("/admin/carreras/editar", "admin/carreras/edit.php")->only(ADMIN);
$router->get("/admin/carreras/nuevo", "admin/carreras/create.php")->only(ADMIN);

$router->post("/admin/carreras", "admin/carreras/store.php")->only(ADMIN);

$router->delete("/admin/carreras", "admin/carreras/archive.php")->only(ADMIN);

$router->patch("/admin/carreras", "admin/carreras/update.php")->only(ADMIN);

# Reportes

$router->get("/admin/reportes","admin/reportes/index.php")->only(ADMIN);
$router->get("/admin/resumenEvaluacion","admin/reportes/resumenEvaluacion.php")->only(ADMIN);
$router->get("/admin/resumenEficacia","admin/reportes/resumenEficacia.php")->only(ADMIN);

# Formatos

$router->get("/admin/formatos","admin/formatos/index.php")->only(ADMIN);
$router->get("/admin/formatos/tecNM","admin/formatos/tecNM.php")->only(ADMIN);
$router->get("/admin/formatos/F06PSA19.02","admin/formatos/F06PSA19.02.php")->only(ADMIN);