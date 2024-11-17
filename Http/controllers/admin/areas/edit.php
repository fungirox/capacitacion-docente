<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$career = $db->query("SELECT * FROM tblArea WHERE AREAID = ?", [$_GET["id"]])->getOrFail();

# AUTORIZAR QUE SEA ADMIN

$title = "Editar Área";

require view("admin/areas/edit.view.php");
