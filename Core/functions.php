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
    require view("errors/{$status}.php");
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

function isValidInput($errors, $key) {
    return isset($errors[$key]) ? 'is-invalid' : '';
}
