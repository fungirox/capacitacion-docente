<?php

use Core\App;
use Core\Repositories\AreaRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'AREA_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$areasData = App::resolve(AreaRepository::class)->getAllWithParams(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/areas/index.view.php", [
    "title" => $archivados ? "Áreas Archivadas" : "Áreas",
    "allAreas" => $areasData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $areasData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
