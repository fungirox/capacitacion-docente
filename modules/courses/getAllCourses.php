<?php
require_once "../config/connection.php";

$query = "SELECT * FROM tblCurso";
$getAllCourses = $connection->prepare($query);
$getAllCourses->execute();
$allCourses = $getAllCourses->fetchAll(PDO::FETCH_ASSOC);