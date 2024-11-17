<?php

namespace Core\Middleware;

use Core\Session;
use Core\Roles\Roles;

class Admin extends MiddlewareTemplate {

    public function handle() {
        if (!$this->isAuthenticated()) {
            redirect("/login");
        } elseif (Session::role() !== Roles::ADMIN) {
            redirect("/");
        }
    }
}
