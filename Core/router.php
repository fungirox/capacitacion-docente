<?php

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        if ($uri === "/") {
            header("Location: /admin/cursos");
            die();
        }
        require base_path($routes[$uri]);
    } else {
        abort();
    }
};

function abort($code = 404) {
    http_response_code($code);
    require view("errors/{$code}.php");
    die();
};

$routes = require base_path("routes.php");
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

routeToController($uri, $routes);
