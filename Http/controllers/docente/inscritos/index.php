<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $allAreas = $db->query("SELECT * FROM tblArea")->getAll();

$title = "Inscritos";


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

$allCourses = $db->query("SELECT * FROM tblCurso, tblCursoDocente 
WHERE tblCursoDocente.CURSOID = tblCurso.CURSOID 
AND tblCursoDocente.DOCENTEID = ?", [$docenteid])->getAll();

return view("/docente/inscritos/index.view.php");
