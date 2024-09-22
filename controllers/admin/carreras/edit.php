<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$career = $db->query("SELECT * FROM tblCarrera WHERE CARRERAID = ?", [$_GET["id"]])->getOrFail();

# AUTORIZAR QUE SEA ADMIN

$title = "Editar Carrera";

require view("admin/carreras/edit.view.php");
