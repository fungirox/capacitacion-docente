<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$rol = $_POST["rol"];
$username = $_POST["username"];
$genero = $_POST["genero"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];
$confirmarContraseña = $_POST["confirmarContraseña"];
$baseOrHoras = $_POST["base-horas"];
$horasBase = $_POST["horas-base"];
$isDocenteInstructor = isset($_POST["docente-instructor"]) ? $_POST["docente-instructor"] : "0";

if (!Validator::string($username)) {
    $errors['username'] = "Favor de introducir un nómbre de usuario válido.";
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

if (!Validator::string($contraseña, 4, 32)) {
    $errors['contraseña'] = "Favor de introducir una contraseña válida.";
}

if (strcmp($contraseña, $confirmarContraseña) !== 0) {
    $errors['confirmarContraseña'] = "Las contraseñas no coinciden.";
}

$user = $db->query("SELECT * FROM tblUsuario WHERE USER_NombreUsuario = ?", [$username])->get();

if ($user) {
    $errors['username'] = "Un usuario con esa nómina ya existe.";
}

if (!empty($errors)) {
    return require view("admin/usuarios/create.view.php");
} else {
    $db->query(
        "INSERT INTO tblUsuario (USER_NombreUsuario, USER_Password, USER_Nombre, USER_Apellido, USER_Email, USER_Genero) VALUES (?, ?, ?, ?, ?, ?)",
        [$username, password_hash($contraseña, PASSWORD_BCRYPT), $nombre, $apellido, $email, $genero]
    );

    $userId = $db->lastInsertId();

    switch ($rol) {
        case "docente":
            addDocente($db, $userId, $username, $baseOrHoras, $horasBase);

            if ($isDocenteInstructor) {
                addInstructor($db, $userId);
            }
            break;
        case "instructor":
            addInstructor($db, $userId);
            break;
        case "administrador":
            addAdministrador($db, $userId);
            break;
    }

    header("location: /admin/usuarios");
    die();
}

function addDocente($db, $userId, $username, $baseOrHoras, $horasBase) {
    $db->query(
        "INSERT INTO tblDocente (USERID, DOCENTE_Nomina, DOCENTE_Base, DOCENTE_Horas_Base) VALUES (?, ?, ?, ?)",
        [$userId, $username, $baseOrHoras, $horasBase]
    );
}

function addInstructor($db, $userId) {
    $db->query(
        "INSERT INTO tblInstructor (USERID) VALUES (?)",
        [$userId]
    );
}

function addAdministrador($db, $userId) {
    $db->query(
        "INSERT INTO tblAdmin (USERID) VALUES (?)",
        [$userId]
    );
}
