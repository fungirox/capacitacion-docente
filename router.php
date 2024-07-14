<?php
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [

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
    "/nuevo-docente" => "controllers/nuevoDocente.php",
    "/horario" => "controllers/horario.php",
    "/historial" => "controllers/historial.php",
];

function abort($code = 404) {
    http_response_code($code);
    require "views/errors/{$code}.php";
    die();
};

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        if ($uri === "/") {
            header("Location: /oferta");
            die();
        }
        require $routes[$uri];
    } else {
        abort();
    }
};

routeToController($uri, $routes);
