<?php

namespace Core\Middleware;

abstract class MiddlewareTemplate {

    protected function isAuthenticated() {
        return $_SESSION["user"] ?? false;
    }

    public function handle() {
        if ($this->isAuthenticated()) {
            redirect("/");
        }
    }
}
