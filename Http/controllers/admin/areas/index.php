<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$allAreas = $db->query("SELECT * FROM tblArea")->getAll();

$title = "Áreas";

require  view("/admin/areas/index.view.php");
