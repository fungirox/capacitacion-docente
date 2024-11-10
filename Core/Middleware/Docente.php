<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class Docente extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            $this->redirect("/login");
        } elseif ($_SESSION["user"]["rol"] !== Roles::DOCENTE) {
            $this->redirect("/");
        }
    }
}
