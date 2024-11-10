<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $allAreas = $db->query("SELECT * FROM tblArea")->getAll();

$title = "Inscritos";

require  view("/docente/inscritos/index.view.php");
