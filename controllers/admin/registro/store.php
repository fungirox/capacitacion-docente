<?php

use Core\App;
use Core\Database;
use Core\Validator;

$nomina = $_POST["nomina"];
$cip = $_POST["cip"];

# Validar los inputs
$errors = [];

if (!Validator::nomina($nomina)) {
    $errors["nomina"] = "Favor de ingresar una nómina válida.";
}

if (!Validator::cip($cip)) {
    $errors["cip"] = "Favor de ingresar un CIP válido.";
}

if (!empty($errors)) {
    return require view("admin/registro/create.view.php");
}

$db = App::resolve(Database::class);

$db->query("SELECT * FROM");
# Validar si ya existe el usuario

    # Si ya existe, se redirecciona al login
    # Si no existe, se crea y sea hace login redireccionando a home.

dd("Nómina: {$nomina}, CIP: {$cip}");