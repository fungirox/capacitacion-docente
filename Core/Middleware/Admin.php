<?php

namespace Core\Middleware;

class Admin {

    public function handle() {
        if (! $_SESSION["admin"] ?? false) {
            header("location: /login");
            exit();
        }
    }
}
