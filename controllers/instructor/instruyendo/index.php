<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// $allAreas = $db->query("SELECT * FROM tblArea")->getAll();

$title = "Cursos Instruyenndo";

require  view("/instructor/instruyendo/index.view.php");
