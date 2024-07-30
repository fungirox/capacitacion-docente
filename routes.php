<?php

return [
    # Auth

    "/login" => "views/login.view.php",
    "/authenticate" => "controllers/auth/authenticate.php",
    "/logout" => "controllers/auth/logOut.php",
    "/" => "controllers/oferta.php",

    # Administradores

    "/admin/cursos" => "controllers/admin/cursos.php",
    "/admin/historial" => "controllers/admin/historial.php",

    # Personal
    "/admin/docentes" => "controllers/admin/docentes.php",
    "/admin/instructores" => "controllers/admin/instructores.php",

    # Documentación
    "/admin/reportes" => "controllers/admin/reportes.php",
    "/admin/formatos" => "controllers/admin/formatos.php",

    # Académico
    # Áreas
    "/admin/areas" => "controllers/admin/areas/areas.php",
    "/admin/areas/nuevo" => "controllers/admin/areas/areas.php",

    # Carreras
    "/admin/carreras" => "controllers/admin/carreras/carreras.php",
    "/admin/carreras/nuevo" => "controllers/admin/carreras/carreras-nuevo.php",

    # Usuarios normales

    # Oferta
    "/oferta" => "controllers/oferta.php",
    "/curso" => "controllers/curso.php",
    "/inscritos" => "controllers/inscritos.php",
    "/instruyendo" => "controllers/instruyendo.php",

    "/horario" => "controllers/horario.php",
    "/historial" => "controllers/historial.php",
];
