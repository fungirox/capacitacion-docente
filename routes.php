<?php

return [
    # Auth
    "/login" => "views/login.view.php",
    "/authenticate" => "controllers/auth/authenticate.php",
    "/logout" => "controllers/auth/logOut.php",
    "/" => "controllers/oferta.php",

    # Oferta
    "/oferta" => "controllers/oferta.php",
    "/curso" => "controllers/curso.php",
    "/inscritos" => "controllers/inscritos.php",
    "/instruyendo" => "controllers/instruyendo.php",

    # Docentes
    "/docentes" => "controllers/docentes.php",
    "/docentes/nuevo" => "views/nuevoDocente.view.php",

    "/horario" => "controllers/horario.php",
    "/historial" => "controllers/historial.php",
];
