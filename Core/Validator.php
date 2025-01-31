<?php

namespace Core;

use Core\Repositories\AdministradorRepository;
use Core\Repositories\AreaRepository;
use Core\Repositories\InstructorRepository;
use DateTime;

class Validator {
    public static function bit($value) {
        return $value == 0 || $value == 1;
    }

    public static function string($value, $min = 1, $max = INF) {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function numeric($value) {
        return is_numeric($value);
    }

    public static function username($value) {
        return !App::resolve(AdministradorRepository::class)->userAlreadyExists($value);
    }

    public static function updateUsername($id, $value) {
        return !App::resolve(AdministradorRepository::class)->userAlreadyExistsForUpdate($id, $value);
    }

    public static function date($value) {
        $format = "Y-m-d";
        $date = DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }

    public static function time($value) {
        $format = "H:i";
        $time = DateTime::createFromFormat($format, $value);
        return $time && $time->format($format) === $value;
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

    public static function areasAreValid($areas) {
        if (empty($areas)) {
            return false;
        }

        $areasRaw = App::resolve(AreaRepository::class)->getAllIds();
        $areasIds = array_column($areasRaw, "AREAID");
        $missingElements = array_diff($areas, $areasIds);

        return empty($missingElements);
    }

    public static function modalidadIsValid($modalidad) {
        return in_array($modalidad, array("presencial", "mixto", "virtual"));
    }

    public static function daysAreValid($days) {
        if (empty($days)) {
            return false;
        }

        $validDays = array("lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo");
        return empty(array_diff($days, $validDays));
    }
}
