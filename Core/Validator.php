<?php

namespace Core;

class Validator {
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function nomina($value) {
        $value = trim($value);
        return strlen($value) === 8;
    }

    public static function cip($value) {
        $value = trim($value);
        return strlen($value) === 5 && ctype_alpha($value);
    }
}
