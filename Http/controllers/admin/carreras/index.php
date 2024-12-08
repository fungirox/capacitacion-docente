<?php

use Core\App;
use Core\Repositories\CarreraRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'CARRERA_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$carrerasData = App::resolve(CarreraRepository::class)->getAll(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/carreras/index.view.php", [
    "title" => $archivados ? "Carreras Archivadas" : "Carreras",
    "allCarreras" => $carrerasData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $carrerasData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
