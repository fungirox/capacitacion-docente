<?php

use Core\Response;

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function urlIs($value) {
    return parse_url($_SERVER["REQUEST_URI"])["path"] === $value;
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

function view($path) {
    return base_path("views/") . $path;
}
