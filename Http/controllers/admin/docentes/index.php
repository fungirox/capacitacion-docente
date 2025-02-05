<?php

use Core\App;
use Core\Repositories\DocenteRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'USER_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$docenteData = App::resolve(DocenteRepository::class)->getAllWithParams(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/docentes/index.view.php", [
    "title" => $archivados ? "Docentes Archivados" : "Docentes",
    "allDocentes" => $docenteData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $docenteData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
