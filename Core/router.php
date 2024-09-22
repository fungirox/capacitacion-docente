<?php

namespace Core;

class Router {

    protected $routes = [];

    public function add($method, $uri, $controller) {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method
        ];
    }

    public function get($uri, $controller) {
        $this->add("GET", $uri, $controller);
    }

    public function post($uri, $controller) {
        $this->add("POST", $uri, $controller);
    }

    public function delete($uri, $controller) {
        $this->add("DELETE", $uri, $controller);
    }

    public function patch($uri, $controller) {
        $this->add("PATCH", $uri, $controller);
    }

    public function put($uri, $controller) {
        $this->add("PUT", $uri, $controller);
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {
                if ($uri === "/") {
                    header("Location: /admin/cursos");
                }
                return require base_path($route["controller"]);
            }
        }

        $this->abort();
    }

    public function abort($code = 404) {
        http_response_code($code);
        require view("errors/{$code}.php");
        die();
    }
}

// function routeToController($uri, $routes) {
//     if (array_key_exists($uri, $routes)) {
//         if ($uri === "/") {
//             header("Location: /admin/cursos");
//             die();
//         }
//         require base_path($routes[$uri]);
//     } else {
//         abort();
//     }
// };F
