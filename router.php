<?php

$routes = require("routes.php");

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

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

routeToController($uri, $routes);
