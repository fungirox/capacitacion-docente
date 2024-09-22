<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$allCareers = $db->query("SELECT * FROM tblCarrera")->getAll();

$title = "Carreras";

require view("admin/carreras/index.view.php");
