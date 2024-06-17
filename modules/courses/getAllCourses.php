<?php
require_once __DIR__."/../../config/connection.php";

$query = "SELECT * FROM tblCurso";
$getAllCourses = $connection->prepare($query);
$getAllCourses->execute();
$allCourses = $getAllCourses->fetchAll(PDO::FETCH_ASSOC);