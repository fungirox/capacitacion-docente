<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Core\Session;

$page = $_GET["page"] ?? 1;
$search = $_GET["search"] ?? "";

$sortInput = $_GET["sortBy"] ?? 'CURSOID-DESC';
$sortParts = explode('-', $sortInput);
$sortBy = $sortParts[0];
$sortOrder = $sortParts[1];

$filterBy = $_GET["filterBy"] ?? null;

$cursosData = App::resolve(CursoRepository::class)->getAllUnsubscribed(
    $page,
    15,
    $search,
    $sortBy,
    $sortOrder,
    $filterBy,
    Session::getUser("id")
);

foreach ($cursosData["data"] as $key => $curso) {
    $areas = explode(",", $curso["areas"]);
    $cursosData["data"][$key]["areas"] = $areas;
}

$paramsActive = (isset($_GET["search"]) && !empty($_GET["search"])) || (isset($_GET["filterBy"]) && !empty($_GET["filterBy"]));

return view("docente/oferta/index.view.php", [
    "title" => "Oferta de Cursos",
    "allCursos" => $cursosData["data"],
    "paramsActive" => $paramsActive,
    "pagination" => $cursosData["pagination"],
    "search" => $search,
    "sortBy" => $sortBy,
    "sortOrder" => $sortOrder,
    "filterBy" => $filterBy
]);
