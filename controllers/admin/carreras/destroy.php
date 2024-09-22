<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

# AUTORIZAR QUE SEA ADMIN

$db->query("DELETE FROM tblCarrera WHERE CARRERAID = ?", [$_POST["id"]]);

header("location: /admin/carreras");
exit();
