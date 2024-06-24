<?php
require 'utils/functions.php';
require "config/config.php";
require "config/Database.php";
require "router.php";

// if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
//     if ($uri !== '/login' && $uri !== '/authenticate') {
//         require $routes['/login'];
//         die();
//     }
// }
