<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Hacer JOIN para obtener el nombre y apellido del usuario relacionado con el docente
$allDocentes = $db->query("
    SELECT d.*, u.USER_nombre, u.USER_apellido 
    FROM tblDocente d
    JOIN tblUsuario u ON d.UserID = u.UserID
")->getAll();

$title = "Docentes";

require view("/docentes/index.view.php");
