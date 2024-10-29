<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$nomina = $_POST["nomina"];
$genero = $_POST["genero"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];
$confirmarContraseña = $_POST["confirmarContraseña"];

if (!Validator::nomina($nombre)) {
    $errors['nomina'] = "Favor de introducir una nómina válida.";
}

if ($genero === 0 || $genero === 1) {
    $errors['genero'] = "Favor de seleccionar un género válido.";
}

if (!Validator::string($nombre, 1, 100)) {
    $errors['nombre'] = "Favor de introducir un nombre válido.";
}

if (!Validator::string($apellido, 1, 100)) {
    $errors['apellido'] = "Favor de introducir un apellido válido.";
}

if (!Validator::email($email, 1, 8)) {
    $errors['email'] = "Favor de introducir un email válido.";
}

if (!Validator::email($contraseña, 8, 32)) {
    $errors['contraseña'] = "Favor de introducir una contraseña válida.";
}

if (strcmp($contraseña, $confirmarContraseña) !== 0) {
    $errors['confirmarContraseña'] = "Las contraseñas no coinciden.";
}

if (!empty($errors)) {
    return require view("admin/usuarios/create.view.php");
}

# AUTORIZAR QUE SEA ADMIN

// $db->query(
//     "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
//     [$nombre, $siglas]
// );

header("location: /admin/usuarios");
die();
