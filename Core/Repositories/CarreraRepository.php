<?php

namespace Core\Repositories;

class CarreraRepository extends RepositoryTemplate {

    public function getAll($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "CARRERA_Nombre", $sortOrder = "ASC") {
        $allowedSortColumns = ['CARRERA_Nombre', 'CARRERA_Siglas'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'CARRERA_Nombre';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'ASC';

        $searchCondition = $search ? "AND (CARRERA_Nombre LIKE ? OR CARRERA_Siglas LIKE ?)" : "";

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
            FROM tblCarrera
            WHERE CARRERA_Archivado = ?
            $searchCondition",
            $countParams
        )->get()['total'];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalPages));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                CARRERAID as id,
                CARRERA_Nombre as nombre,
                CARRERA_Siglas as siglas
            FROM tblCarrera
            WHERE CARRERA_Archivado = ?
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
        return $this->query("SELECT * FROM tblCarrera WHERE CARRERAID = ?", [$id])->getOrFail();
    }

    public function create($values) {
        return $this->query(
            "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
            [$values["nombre"], $values["siglas"]]
        );
    }

    public function update($values) {
        return $this->query(
            "UPDATE tblCarrera SET CARRERA_Nombre = ?, CARRERA_Siglas = ? WHERE CARRERAID = ?",
            [$values["nombre"], $values["siglas"], $values["id"]]
        );
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblCarrera SET CARRERA_Archivado = ? WHERE CARRERAID = ?",
            [$state, $id]
        );
    }
}
