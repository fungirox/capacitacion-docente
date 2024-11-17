<?php

use Core\App;
use Core\Database;
use Core\Roles\Roles;

$admin = Roles::ADMIN;
$docente = Roles::DOCENTE;
$instructor = Roles::INSTRUCTOR;
$docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
$guest = Roles::GUEST;

$allUsers = App::resolve(Database::class)->query(
    "SELECT
	    *,
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
    "
)->getAll();

return view("admin/usuarios/index.view.php", [
    "title" => "Usuarios",
    "allUsers" => $allUsers,
    "admin" => $admin,
    "docente" => $docente,
    "instructor" => $instructor,
    "docenteAndInstructor" => $docenteAndInstructor,
    "guest" => $guest
]);