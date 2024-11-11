<?php

namespace Core\Middleware;

use Core\Roles\Roles;

class Middleware {

    public const MAP = [
        Roles::GUEST => Guest::class,
        Roles::ADMIN => Admin::class,
        Roles::DOCENTE => Docente::class,
        Roles::INSTRUCTOR => Instructor::class,
        Roles::DOCENTE_AND_INSTRUCTOR => DocenteAndInstructor::class,
        Roles::DOCENTE_OR_INSTRUCTOR => DocenteOrInstructor::class,
        Roles::ANY => Any::class
    ];

    public static function resolve($key) {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("No matching middleware found for key $key.");
        }

        (new $middleware)->handle();
    }
}
