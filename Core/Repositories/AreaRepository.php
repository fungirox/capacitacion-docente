<?php

namespace Core\Repositories;

class AreaRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT AREAID AS id, AREA_Nombre AS nombre
            FROM tblArea
            WHERE AREA_Archivado = 0
            ORDER BY AREA_Nombre ASC"
        )->getAll();
    }

    public function getAllWithParams($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "AREA_Nombre", $sortOrder = "ASC") {
        $allowedSortColumns = ['AREA_Nombre', 'AREA_Siglas'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'AREA_Nombre';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'ASC';

        $searchCondition = $search ? "AND (AREA_Nombre LIKE ? OR AREA_Siglas LIKE ?)" : "";

        $params = [$archivado];

        if ($search) {
            $searchParam = "%$search%";
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        $countParams = [$archivado];
        if ($search) {
            $searchParam = "%{$search}%";
            $countParams[] = $searchParam;
            $countParams[] = $searchParam;
        }

        $totalCount = $this->query(
            "SELECT COUNT(*) as total 
            FROM tblArea 
            WHERE AREA_Archivado = ?
            $searchCondition",
            $countParams
        )->get()['total'];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalPages));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                AREAID as id,
                AREA_Nombre as nombre,
                AREA_Siglas as siglas,
                CASE AREA_Carrera
                    WHEN 0 THEN 'Área'
                    WHEN 1 THEN 'Carrera'
                END AS carrera
            FROM tblArea
            WHERE AREA_Archivado = ?
            $searchCondition
            ORDER BY $sortBy $sortOrder
            OFFSET CAST(? AS INT) ROWS
            FETCH NEXT CAST(? AS INT) ROWS ONLY",
            $params
        )->getAll();

        return [
            "data" => $results,
            "pagination" => [
                "totalItems" => $totalCount,
                "totalPages" => $totalPages,
                "currentPage" => $page,
            ]
        ];
    }

    public function getById($id) {
        return $this->query("SELECT * FROM tblArea WHERE AREAID = ?", [$id])->getOrFail();
    }

    public function create($values) {
        return $this->query(
            "INSERT INTO tblArea (AREA_Nombre, AREA_Siglas, AREA_Carrera) VALUES (?, ?, ?)",
            [$values["nombre"], $values["siglas"], $values["tipo"]]
        );
    }

    public function update($values) {
        return $this->query(
            "UPDATE tblArea SET AREA_Nombre = ?, AREA_Siglas = ?, AREA_Carrera = ? WHERE AREAID = ?",
            [$values["nombre"], $values["siglas"], $values["tipo"], $values["id"]]
        );
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblArea SET AREA_Archivado = ? WHERE AREAID = ?",
            [$state, $id]
        );
    }

    public function getAllIds() {
        return $this->query("SELECT AREAID FROM TblArea WHERE TblArea.AREA_Archivado = 0")->getAll();
    }
}
