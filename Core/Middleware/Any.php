<?php

namespace Core\Middleware;

class Any extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            redirect("/login");
        }
    }
}
