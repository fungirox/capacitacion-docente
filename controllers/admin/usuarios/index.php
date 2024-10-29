<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$allCareers = $db->query("SELECT * FROM tblUsuario")->getAll();

$title = "Usuarios";

require view("admin/usuarios/index.view.php");
