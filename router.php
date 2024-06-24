<?php
$baseUrl = 'http://localhost';
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/login' => "views/login.php",
    '/authenticate' => "controllers/authenticate.php",
    '/logout' => "controllers/logOut.php",
    '/' => "controllers/oferta.php",
    '/oferta' => "controllers/oferta.php",
    '/curso' => "controllers/curso.php",
    '/horario' => "views/horario.php",
    '/historial' => "views/historial.php",
];

$abort = function ($code = 404) use ($baseUrl) {
    http_response_code($code);
    require "views/errors/{$code}.php";
    die();
};

$routeToController = function ($uri, $routes) use ($baseUrl, $abort) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        $abort();
    }
};

$routeToController($uri, $routes);
