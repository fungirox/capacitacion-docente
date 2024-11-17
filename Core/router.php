<?php

namespace Core;

use Core\Roles\Roles;
use Core\Middleware\Middleware;

class Router {

    protected $routes = [];

    public function add($method, $uri, $controller) {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "middleware" => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        return $this->add("GET", $uri, $controller);
    }

    public function post($uri, $controller) {
        return $this->add("POST", $uri, $controller);
    }

    public function delete($uri, $controller) {
        return $this->add("DELETE", $uri, $controller);
    }

    public function patch($uri, $controller) {
        return $this->add("PATCH", $uri, $controller);
    }

    public function put($uri, $controller) {
        return $this->add("PUT", $uri, $controller);
    }

    public function only($key) {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;

        return $this;
    }

    public function route($uri, $method) {
        if ($uri === "/") {
            $destination = "";

            if (! Session::has("user")) {
                $destination = "/login";
            } else {
                $destination = match (Session::role()) {
                    Roles::ADMIN => "/admin/cursos",
                    Roles::DOCENTE,
                    Roles::DOCENTE_AND_INSTRUCTOR,
                    Roles::DOCENTE_OR_INSTRUCTOR => "/inscritos",
                    Roles::INSTRUCTOR => "/instruyendo",
                    default => "/logout"
                };
            }

            if ($destination === "/logout") {
                (new Authenticator)->logout();
            }

            redirect($destination);
        }

        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {
                Middleware::resolve($route["middleware"]);

                return require base_path("Http/controllers/" . $route["controller"]);
            }
        }

        $this->abort();
    }

    public function previousUrl() {
        return $_SERVER["HTTP_REFERER"];
    }

    public function abort($code = 404) {
        http_response_code($code);
        view("errors/{$code}.php");
        die();
    }
}
