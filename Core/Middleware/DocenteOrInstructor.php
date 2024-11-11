<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class DocenteOrInstructor extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            $this->redirect("/login");
        } elseif ($_SESSION["user"]["rol"] !== Roles::DOCENTE && $_SESSION["user"]["rol"] !== Roles::INSTRUCTOR && $_SESSION["user"]["rol"] !== Roles::DOCENTE_AND_INSTRUCTOR) {
            $this->redirect("/");
        }
    }
}
