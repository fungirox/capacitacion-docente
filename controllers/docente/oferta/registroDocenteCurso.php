<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$cursoid = $_POST["cursoid"];

$username = isset($_SESSION["user"]["username"]) ? $_SESSION["user"]["username"] : null;

$userIDQuery = $db->query(
    "SELECT USERID FROM tblUsuario WHERE USER_NombreUsuario = ?",
    [$username]
)->get();

$userid = $userIDQuery['USERID'];

$docenteIDQuery = $db->query(
    "SELECT DOCENTEID FROM tblDocente WHERE USERID = ?",
    [$userid]
)->get();

$docenteid = $docenteIDQuery['DOCENTEID'];

$db->query(
    "INSERT INTO tblCursoDocente (CURSOID, DOCENTEID, CURSODOCENTE_Calificacion)
    VALUES (?, ?, ?)",
    [$cursoid, $docenteid, 0]
);


header("location: /oferta");
die();

