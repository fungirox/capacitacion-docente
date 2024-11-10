<?php

namespace Core\Middleware;

abstract class MiddlewareTemplate {

    protected function isAuthenticated() {
        return $_SESSION["user"] ?? false;
    }

    protected function redirect($route) {
        header("location: $route");
        exit();
    }

    public function handle() {
        if ($this->isAuthenticated()) {
            $this->redirect("/");
        }
    }
}
