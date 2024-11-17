<?php

namespace Core\Middleware;

use Core\Session;
use Core\Roles\Roles;

class DocenteAndInstructor extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            redirect("/login");
        } elseif (Session::role() !== Roles::DOCENTE_AND_INSTRUCTOR) {
            redirect("/");
        }
    }
}
