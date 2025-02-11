<?php

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "vendor/autoload.php";

session_start();

date_default_timezone_set("America/Hermosillo");

require BASE_PATH . "Core/functions.php";

require base_path("bootstrap.php");

$router = new \Core\Router();
$routes = require base_path("Core/routes/routes.php");

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$method = isset($_POST["_method"]) ? $_POST["_method"] : $_SERVER["REQUEST_METHOD"];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash("errors", $exception->errors);
    Session::flash("old", $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();
