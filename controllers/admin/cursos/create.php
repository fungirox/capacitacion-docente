<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$teachers = $db->query(
    "SELECT i.INSTRUCTORID, u.USERID, u.USER_Nombre, u.USER_Apellido
    FROM tblUsuario u
    JOIN tblInstructor i ON u.USERID = i.USERID;
    "
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

require view("admin/cursos/create.view.php");
