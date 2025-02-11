<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Repositories\AdministradorRepository;
use Core\Repositories\AreaRepository;
use Core\Repositories\AsistenciaCursoRepository;
use Core\Repositories\CarreraRepository;
use Core\Repositories\CursoDocenteRepository;
use Core\Repositories\CursoRepository;
use Core\Repositories\DocenteRepository;
use Core\Repositories\EncuestaRepository;
use Core\Repositories\InstructorRepository;
use Core\Repositories\PreguntaRepository;
use Core\Repositories\RespuestaPreguntaRepository;
use Core\Repositories\RespuestaRepository;
use Core\Repositories\UsuarioRepository;
use Core\Repositories\ConstanciaRepository;
use Core\Repositories\PersonalRepository;

$container = new Container();

$container->bind("Core\Database", function () {
    return new Database();
});

$container->bind("Core\Repositories\AdministradorRepository", function () {
    return new AdministradorRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\AreaRepository", function () {
    return new AreaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\CarreraRepository", function () {
    return new CarreraRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\CursoDocenteRepository", function () {
    return new CursoDocenteRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\CursoRepository", function () {
    return new CursoRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\DocenteRepository", function () {
    return new DocenteRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\EncuestaRepository", function () {
    return new EncuestaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\InstructorRepository", function () {
    return new InstructorRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\PreguntaRepository", function () {
    return new PreguntaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\RespuestaPreguntaRepository", function () {
    return new RespuestaPreguntaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\RespuestaRepository", function () {
    return new RespuestaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\UsuarioRepository", function () {
    return new UsuarioRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\ConstanciaRepository", function () {
    return new ConstanciaRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\PersonalRepository", function () {
    return new PersonalRepository(App::resolve(Database::class));
});

$container->bind("Core\Repositories\AsistenciaCursoRepository", function () {
    return new AsistenciaCursoRepository(App::resolve(Database::class));
});

App::setContainer($container);
