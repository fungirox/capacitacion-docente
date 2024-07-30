<?php

$db = new Database();
$allCareers = $db->query("SELECT * FROM tblCarrera")->getAll();

$title = "Carreras";

require  "views/admin/carreras/carreras.view.php";
