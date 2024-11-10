<?php

namespace Core\Middleware;

class Any {

    public function handle() {
        if (! $_SESSION["user"] ?? false) {
            header("location: /login");
            exit();
        }
    }
}
