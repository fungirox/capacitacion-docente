<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class DocenteAndInstructor extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            $this->redirect("/login");
        } elseif ($_SESSION["user"]["rol"] !== Roles::DOCENTE_AND_INSTRUCTOR) {
            $this->redirect("/");
        }
    }
}
