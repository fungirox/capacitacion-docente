<?php

use Core\App;
use Core\Repositories\CursoRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'CURSOID-DESC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$cursosData = App::resolve(CursoRepository::class)->getAll(
    $archivados ? 1 : 0,
    $page,
    3,
    $search,
    $sortBy,
    $sortOrder
);

foreach ($cursosData["data"] as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $cursosData["data"][$key]["areas"] = $areas;
}

$paramsActive = isset($_GET["search"]) && !empty($_GET["search"]);

return view("admin/cursos/index.view.php", [
    "title" => "Cursos",
    "allCourses" => $cursosData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $cursosData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder
]);
