<?php

namespace Core\Middleware;

use Core\Session;
use Core\Roles\Roles;

class DocenteOrInstructor extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            redirect("/login");
        } elseif (Session::role() !== Roles::DOCENTE && Session::role() !== Roles::INSTRUCTOR && Session::role() !== Roles::DOCENTE_AND_INSTRUCTOR) {
            redirect("/");
        }
    }
}
