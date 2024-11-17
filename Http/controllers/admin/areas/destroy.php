<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

# AUTORIZAR QUE SEA ADMIN

$db->query("DELETE FROM tblArea WHERE AREAID = ?", [$_POST["id"]]);

header("location: /admin/areas");
exit();
