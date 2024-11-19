<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;
use Core\Session;

$db = App::resolve(Database::class);

$isDocenteAndInstructor = Session::role() === Roles::DOCENTE_AND_INSTRUCTOR;

$cursosNoEvaluados = $db->query(
    "SELECT 
        c.CURSOID,
        c.CURSO_Nombre
    FROM tblUsuario u
    JOIN tblDocente d ON u.USERID = d.USERID
    JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
    JOIN tblCurso c ON cd.CURSOID = c.CURSOID
    WHERE u.USER_NombreUsuario = ?
    AND cd.CURSODOCENTE_EncuestaEvaluacion IS NULL
    AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
    AND c.CURSO_En_Progreso = 0;",
    [$_SESSION["user"]["username"]]
)->getAll();


$cursosSinSegundaEncuesta = $db->query(
    "SELECT 
        c.CURSOID,
        c.CURSO_Nombre
    FROM tblUsuario u
    JOIN tblDocente d ON u.USERID = d.USERID
    JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
    JOIN tblCurso c ON cd.CURSOID = c.CURSOID
    WHERE u.USER_NombreUsuario = ?
    AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
    AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
    AND c.CURSO_En_Progreso = 0;",
    [$_SESSION["user"]["username"]]
)->getAll();


$cursosConcluidos = $db->query(
    "SELECT 
        c.CURSOID,
        c.CURSO_Nombre
    FROM tblUsuario u
    JOIN tblDocente d ON u.USERID = d.USERID
    JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
    JOIN tblCurso c ON cd.CURSOID = c.CURSOID
    WHERE u.USER_NombreUsuario = ?
    AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
    AND cd.CURSODOCENTE_EncuestaEficacia = 1
    AND c.CURSO_En_Progreso = 0;",
    [$_SESSION["user"]["username"]]
)->getAll();

return view("/docenteOrInstructor/historial/index.view.php", [
    "title" => "Historial de Cursos",
    "isDocenteAndInstructor" => $isDocenteAndInstructor,
    "cursosNoEvaluados" => $cursosNoEvaluados,
    "cursosSinSegundaEncuesta" => $cursosSinSegundaEncuesta,
    "cursosConcluidos" => $cursosConcluidos
]);
