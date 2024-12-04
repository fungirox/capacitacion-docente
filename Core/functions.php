<?php

use Core\Response;

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function urlIs($value) {
    return str_contains(parse_url($_SERVER["REQUEST_URI"])["path"], $value);
}

function abort($status = 404) {
    http_response_code($status);
    view("errors/{$status}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (!$condition) {
        abort($status);
    }
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $attributes = []) {
    extract($attributes);

    require base_path("views/") . $path;
}

function redirect($path) {
    header("location: $path");
    exit();
}

function old($key, $default = "") {
    return Core\Session::get("old")[$key] ?? $default;
}

function cleanOld($key, $default = "") {
    return htmlspecialchars(old($key, $default));
}

function isValidInput($errors, $key) {
    return isset($errors[$key]) ? "is-invalid" : "";
}

function formatDate($sqlDate) {
    $dateTime = DateTime::createFromFormat("Y-m-d", $sqlDate);

    $months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    $monthIndex = (int)$dateTime->format("m") - 1;
    $day = $dateTime->format("d");
    $year = $dateTime->format("Y");

    return sprintf("%s %s, %s", $months[$monthIndex], $day, $year);
}

function fullFormattedDays($dias) {
    $dayOrder = [
        'lunes' => 1,
        'martes' => 2,
        'miercoles' => 3,
        'jueves' => 4,
        'viernes' => 5,
        'sabado' => 6,
        'domingo' => 7
    ];

    $diasArray = explode(",", $dias);

    usort($diasArray, function ($a, $b) use ($dayOrder) {
        $orderA = $dayOrder[strtolower($a)] ?? PHP_INT_MAX;
        $orderB = $dayOrder[strtolower($b)] ?? PHP_INT_MAX;
        return $orderA - $orderB;
    });

    $diasArray = array_map(function ($dia) {
        return str_replace('miercoles', 'miércoles', $dia);
    }, $diasArray);

    $result = count($diasArray) > 1
        ? implode(', ', array_slice($diasArray, 0, -1)) . ' y ' . end($diasArray)
        : $diasArray[0];

    return ucfirst($result);
}

function shortFormattedDays($dias) {
    $dayOrder = [
        'lunes' => 1,
        'martes' => 2,
        'miercoles' => 3,
        'jueves' => 4,
        'viernes' => 5,
        'sabado' => 6,
        'domingo' => 7
    ];

    $diasMap = [
        'lunes' => 'LU',
        'martes' => 'MA',
        'miercoles' => 'MI',
        'jueves' => 'JU',
        'viernes' => 'VI',
        'sabado' => 'SA',
        'domingo' => 'DO'
    ];

    $diasArray = explode(",", $dias);

    $diasAbreviados = array_map(function ($dia) use ($diasMap) {
        return $diasMap[$dia] ?? $dia;
    }, $diasArray);

    usort($diasAbreviados, function ($a, $b) use ($dayOrder, $diasMap) {
        $originalA = array_search($a, $diasMap);
        $originalB = array_search($b, $diasMap);

        $orderA = $dayOrder[$originalA] ?? PHP_INT_MAX;
        $orderB = $dayOrder[$originalB] ?? PHP_INT_MAX;

        return $orderA - $orderB;
    });

    return implode(' ', $diasAbreviados);
}


function formattedDateRange($startDate, $endDate) {
    if (substr($startDate, -4) === substr($startDate, -4)) {
        return substr($startDate, 0, -6) . " - " . $endDate;
    }

    return $startDate . " - " - $endDate;
}

function getAmOrPm($hour) {
    return $hour < 12 ? "AM" : "PM";
}

function formattedHourRange($startHour, $endHour) {
    return substr($startHour, 0, 5) . " " . getAmOrPm($startHour) . " - " . substr($endHour, 0, 5) . " " . getAmOrPm($endHour);
}
