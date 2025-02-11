<?php

use Core\App;
use Core\Repositories\PersonalRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'PERSONAL_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$personalData = App::resolve(PersonalRepository::class)->getAllWithParams(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/personal/index.view.php", [
    "title" => $archivados ? "Personal Archivados" : "Personal",
    "allPersonal" => $personalData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $personalData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
