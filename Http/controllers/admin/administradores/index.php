<?php

use Core\App;
use Core\Repositories\AdministradorRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'USER_Nombre-ASC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$adminsData = App::resolve(AdministradorRepository::class)->getAllWithParams(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder
);

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("/admin/administradores/index.view.php", [
    "title" => $archivados ? "Administradores Archivados" : "Administradores",
    "allAdmins" => $adminsData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $adminsData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
