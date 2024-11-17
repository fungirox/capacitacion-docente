<?php

use Core\App;
use Core\Database;

App::resolve(Database::class)->query("DELETE FROM tblCarrera WHERE CARRERAID = ?", [$_POST["id"]]);

redirect("/admin/carreras");
