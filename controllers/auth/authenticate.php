<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Validator;

$db = App::resolve(Database::class);

$username = $_POST["username"];
$password = $_POST["password"];

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

$admin = Roles::ADMIN;
$docente = Roles::DOCENTE;
$instructor = Roles::INSTRUCTOR;
$docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
$guest = Roles::GUEST;

$user = $db->query(
    "SELECT
	    usuario.USERID,
		usuario.USER_NombreUsuario,
        usuario.USER_Password,
	    CASE
            WHEN admin.ADMINID IS NOT NULL THEN '$admin'
            WHEN docente.DOCENTEID IS NOT NULL AND instructor.INSTRUCTORID IS NOT NULL THEN '$docenteAndInstructor'
            WHEN docente.DOCENTEID IS NOT NULL THEN '$docente'
            WHEN instructor.INSTRUCTORID IS NOT NULL THEN '$instructor'
            ELSE '$guest'
        END AS rol
    FROM
        [tblUsuario] usuario
        LEFT JOIN tblAdmin admin on usuario.USERID = admin.USERID
        LEFT JOIN tblDocente docente on usuario.USERID = docente.USERID
        LEFT JOIN tblInstructor instructor on usuario.USERID = instructor.USERID
    WHERE USER_NombreUsuario = ?
    ",
    [$username]
)->get();

if ($user) {
    if (password_verify($password, $user["USER_Password"])) {
        login([
            "id" => $user["USERID"],
            "username" => $username,
            "rol" => $user["rol"]
        ]);
        header("location: /");
        exit();
    }
}

$errors["password"] = "No se encontró una cuenta con ese usuario o contraseña.";
return require view("auth/login.view.php");
