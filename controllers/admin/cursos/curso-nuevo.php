<?php

use Core\Database;

$db = new Database();

$teachers = $db->query(
    "SELECT u.USERID, u.USER_Nombre, u.USER_Apellido
    FROM tblUsuario u
    JOIN tblUsuarioRoles ur ON u.USERID = ur.USERID
    JOIN tblRol r ON ur.ROLID = r.ROLID
    WHERE r.ROL_Nombre = 'Instructor'"
)->getAll();
$areas = $db->query("SELECT * FROM dbo.tblArea")->getAll();

$todayDate = new DateTime();
$formattedToday = $todayDate->format('Y-m-d');
$tomorrowDate = new DateTime('tomorrow');
$formattedTomorrow = $tomorrowDate->format('Y-m-d');

$weekdays = [
    'lunes' => 'Lunes',
    'martes' => 'Martes',
    'miercoles' => 'Miércoles',
    'jueves' => 'Jueves',
    'viernes' => 'Viernes'
];

$title = "Registrar Curso";

require view("admin/cursos/curso-nuevo.view.php");
