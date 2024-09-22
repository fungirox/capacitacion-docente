<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind("Core\Database", function () {
    return new Database();
});

App::setContainer($container);
