<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Repositories\AreaRepository;
use Core\Repositories\CarreraRepository;
use Core\Repositories\CursoRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\InstructorRepository;
use Core\Repositories\UsuarioRepository;

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

$container->bind("Core\Repositories\CursoRepository", function () {
    return new CursoRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\UsuarioRepository", function () {
    return new UsuarioRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\DocenteRepository", function () {
    return new DocenteRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\InstructorRepository", function () {
    return new InstructorRepository(App::resolve(Database::class));
});

App::setContainer($container);
