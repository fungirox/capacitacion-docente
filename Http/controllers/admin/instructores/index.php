<?php

use Core\App;
use Core\Repositories\InstructorRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'USER_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$instructorData = App::resolve(InstructorRepository::class)->getAllWithParams(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/instructores/index.view.php", [
    "title" => $archivados ? "Instructores Archivados" : "Instructores",
    "allInstructores" => $instructorData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $instructorData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
