<?php
$baseUrl = "http://localhost";
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [
    "/login" => "views/login.php",
    "/authenticate" => "controllers/auth/authenticate.php",
    "/logout" => "controllers/auth/logOut.php",
    "/" => "controllers/oferta.php",
    "/oferta" => "controllers/oferta.php",
    "/curso" => "controllers/curso.php",
    "/inscritos" => "controllers/inscritos.php",
    "/instruyendo" => "controllers/instruyendo.php",
    "/horario" => "controllers/horario.php",
    "/historial" => "controllers/historial.php",
];

$abort = function ($code = 404) use ($baseUrl) {
    http_response_code($code);
    require "views/errors/{$code}.php";
    die();
};

$routeToController = function ($uri, $routes) use ($baseUrl, $abort) {
    if (array_key_exists($uri, $routes)) {
        if ($uri === "/") {
            header("Location: /oferta");
            die();
        }
        require $routes[$uri];
    } else {
        $abort();
    }
};

$routeToController($uri, $routes);
