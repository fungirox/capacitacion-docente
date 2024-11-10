<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class Instructor extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            $this->redirect("/login");
        } elseif ($_SESSION["user"]["rol"] !== Roles::INSTRUCTOR) {
            $this->redirect("/");
        }
    }
}
