<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query("DELETE FROM tblArea WHERE AREAID = ?", [$_POST["id"]]);

redirect("/admin/areas");
