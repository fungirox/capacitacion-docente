<?php

namespace Core;

use Core\Repositories\InstructorRepository;

class Validator {
    public static function string($value, $min = 1, $max = INF) {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function numeric($value) {
        return is_numeric($value);
    }

    public static function date($value) {
        return (bool)strtotime($value);
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function nomina($value) {
        return strlen($value) === 8;
    }

    public static function cip($value) {
        return strlen($value) === 5 && ctype_alpha($value);
    }

    public static function tipoDeServicio($servicio) {
        return in_array($servicio, array("curso", "taller", "diplomado"));
    }

    public static function isValidInstructor($instructorId) {
        return !empty(App::resolve(InstructorRepository::class)->getAllIds($instructorId));
    }
}
