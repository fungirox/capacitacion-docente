<?php

namespace Core\Middleware;

class Guest {

    public function handle() {
        if ($_SESSION["admin"] ?? false) {
            header("location: /login");
            exit();
        }
    }
}
