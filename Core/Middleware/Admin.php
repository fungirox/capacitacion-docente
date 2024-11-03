<?php

namespace Core\Middleware;

class Admin {

    public function handle() {
        if (! $_SESSION["user"] ?? false) {
            header("location: /login");
            exit();
        }
    }
}
