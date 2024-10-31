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

if (!Validator::nomina($nomina)) {
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

if (!Validator::email($email)) {
    $errors['email'] = "Favor de introducir un email válido.";
}

if (!Validator::string($contraseña, 8, 32)) {
    $errors['contraseña'] = "Favor de introducir una contraseña válida.";
}

if (strcmp($contraseña, $confirmarContraseña) !== 0) {
    $errors['confirmarContraseña'] = "Las contraseñas no coinciden.";
}

$user = $db->query("SELECT * FROM tblUsuario WHERE USERID = ?", [$nomina])->get();

if ($user) {
    $errors['nomina'] = "Un usuario con esa nómina ya existe.";
}

if (!empty($errors)) {
    return require view("admin/usuarios/create.view.php");
} else {
    $db->query(
        "INSERT INTO tblUsuario (USER_NombreUsuario, USER_Password, USER_Nombre, USER_Apellido, USER_Email, USER_Genero) VALUES (?, ?, ?, ?, ?, ?)",
        [$nomina, password_hash($contraseña, PASSWORD_BCRYPT), $nombre, $apellido, $email, $genero]
    );

    $_SESSION["user"] = [
        "userName" => $nomina
    ];

    header("location: /admin/usuarios");
    die();
}
