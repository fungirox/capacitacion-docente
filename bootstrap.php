<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Repositories\AreaRepository;
use Core\Repositories\CarreraRepository;

$container = new Container();

$container->bind("Core\Database", function () {
    return new Database();
});

$container->bind("Core\Repositories\AreaRepository", function () {
    return new AreaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\CarreraRepository", function () {
    return new CarreraRepository(App::resolve(Database::class));
});

App::setContainer($container);
