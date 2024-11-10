<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class Admin extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            $this->redirect("/login");
        } elseif ($_SESSION["user"]["rol"] !== Roles::ADMIN) {
            $this->redirect("/");
        }
    }
}
