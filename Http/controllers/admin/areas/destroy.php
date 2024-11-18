<?php

use Core\App;
use Core\Database;

App::resolve(Database::class)->query("DELETE FROM tblArea WHERE AREAID = ?", [$_POST["id"]]);

redirect("/admin/areas");
