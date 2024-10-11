<?php

// return [
//     # Auth

//     "/login" => "views/login.view.php",
//     "/authenticate" => "controllers/auth/authenticate.php",
//     "/logout" => "controllers/auth/logOut.php",
//     "/" => "controllers/oferta.php",

//     # Administradores

//     # Cursos
//     "/admin/cursos" => "controllers/admin/cursos/cursos.php",
//     "/admin/cursos/nuevo" => "controllers/admin/cursos/curso-nuevo.php",
//     "/admin/curso" => "controllers/admin/cursos/curso.php",

//     # Historial
//     "/admin/historial" => "controllers/admin/historial/historial.php",

//     # Docentes
//     "/admin/docentes" => "controllers/admin/docentes/docentes.php",
//     "/admin/docentes/nuevo" => "controllers/admin/docentes/docentes-nuevo.php",

//     # Instructores
//     "/admin/instructores" => "controllers/admin/instructores.php",

//     # Documentación
//     "/admin/reportes" => "controllers/admin/reportes.php",
//     "/admin/formatos" => "controllers/admin/formatos.php",

//     # Académico
//     # Áreas
//     "/admin/areas" => "controllers/admin/areas/areas.php",
//     "/admin/areas/nuevo" => "controllers/admin/areas/areas.php",

//     # Carreras
//     "/admin/carreras" => "controllers/admin/carreras/carreras.php",
//     "/admin/carreras/nuevo" => "controllers/admin/carreras/carreras-nuevo.php",

//     # Usuarios normales

//     # Oferta
//     "/oferta" => "controllers/oferta.php",
//     "/inscritos" => "controllers/inscritos.php",
//     "/instruyendo" => "controllers/instruyendo.php",

//     "/horario" => "controllers/horario.php",
//     "/historial" => "controllers/historial.php",

//     # Encuesta TODO
//     "/evaluarCurso" => "views/encuestas/encuesta-F04PSA19.php",

//     # Generar Reporte
//     "/generarReporte" => "controllers/generarReporte.php",
// ];
# Administradores

# Cursos

# Carreras

$router->get("/admin/carreras", "controllers/admin/carreras/index.php");
$router->delete("/admin/carreras", "controllers/admin/carreras/destroy.php");
$router->get("/admin/carreras/editar", "controllers/admin/carreras/edit.php");
$router->patch("/admin/carreras", "controllers/admin/carreras/update.php");
$router->get("/admin/carreras/nuevo", "controllers/admin/carreras/create.php");
$router->post("/admin/carreras", "controllers/admin/carreras/store.php");

$router->get("/admin/registro", "controllers/admin/registro/create.php");
$router->post("/admin/registro", "controllers/admin/registro/store.php");
