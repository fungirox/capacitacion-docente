<?php

namespace Core;

class Validator {
    public static function string($value, $min = 1, $max = INF) {
        return strlen($value) >= $min && strlen($value) <= $max;
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

    public static function servicio($servicio) {
        $servicios = array("curso", "taller", "diplomado");
        return in_array($servicio, $servicios);
    }

    public static function inArray($value, $array) {
        return in_array($value, $array);
    }

    public static function numeric($value) {
        return is_numeric($value);
    }

    public static function date($value) {
        return (bool)strtotime($value);
    }
}
