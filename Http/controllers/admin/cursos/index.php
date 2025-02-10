<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Repositories\PersonalRepository;

$archivados = isset($_GET["archivados"]);
$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'CURSOID-DESC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$filterBy = $_GET["filterBy"] ?? null;

$personal = App::resolve(PersonalRepository::class)->getAll();

$cursosData = App::resolve(CursoRepository::class)->getAll(
    $archivados ? 1 : 0,
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder,
    $filterBy
);

foreach ($cursosData["data"] as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $cursosData["data"][$key]["areas"] = $areas;
}

$paramsActive = (isset($_GET["search"]) && !empty($_GET["search"])) || (isset($_GET["filterBy"]) && !empty($_GET["filterBy"]));

return view("admin/cursos/index.view.php", [
    "title" => $archivados ? "Cursos Archivados" : "Cursos",
    "personal" => $personal,
    "allCursos" => $cursosData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $cursosData["pagination"],
    "archivados" => $archivados,
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder,
    "filterBy" => $filterBy
]);
