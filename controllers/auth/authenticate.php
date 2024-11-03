<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$username = $_POST["username"];
$password = $_POST["password"];
$rol = $_POST["rol"];

$errors = [];

if (!Validator::string($username)) {
    $errors["username"] = "Favor de introducir un nombre de usuario.";
}

if (!Validator::string($password)) {
    $errors["password"] = "Favor de introducir una contraseña.";
}

if (!empty($errors)) {
    return require view("auth/login.view.php");
}

$user = $db->query("SELECT * FROM tblUsuario WHERE USER_NombreUsuario = ?", [$username])->get();

if ($user) {
    if (password_verify($password, $user["USER_Password"])) {
        login([
            "username" => $username,
            "rol" => $rol
        ]);
        header("location: /");
        exit();
    }
}

$errors["password"] = "No se encontró una cuenta con ese usuario o contraseña.";
return require view("auth/login.view.php");
