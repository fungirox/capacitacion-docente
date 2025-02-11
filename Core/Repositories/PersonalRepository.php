<?php

namespace Core\Repositories;

class PersonalRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT
                PERSONALID AS id,
                PERSONAL_Nombre AS nombre,
                PERSONAL_Puesto AS puesto
            FROM tblPersonal
            WHERE PERSONAL_Archivado = 0
            ORDER BY PERSONAL_Nombre ASC"
        )->getAll();
    }

    public function getAllWithParams($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "PERSONAL_Nombre", $sortOrder = "ASC") {
        $allowedSortColumns = ['PERSONAL_Nombre'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'PERSONAL_Nombre';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'ASC';

        $searchCondition = $search ? "AND (PERSONAL_Nombre LIKE ?)" : "";

        $params = [$archivado];

        if ($search) {
            $searchParam = "%$search%";
            $params[] = $searchParam;
        }

        $countParams = [$archivado];
        if ($search) {
            $searchParam = "%{$search}%";
            $countParams[] = $searchParam;
        }

        $totalCount = $this->query(
            "SELECT COUNT(*) as total 
            FROM tblPersonal 
            WHERE PERSONAL_Archivado = ?
            $searchCondition",
            $countParams
        )->get()['total'];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalPages));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                PERSONALID as id,
                PERSONAL_Nombre as nombre,
                PERSONAL_Puesto as puesto
            FROM tblPersonal
            WHERE PERSONAL_Archivado = ?
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

    public function getById($personalId) {
        return $this->query(
            "SELECT * FROM 
                tblPersonal
            WHERE 
                PERSONALID = ?",
            [$personalId]
        )->getOrFail();
    }

    public function create($values) {
        return $this->query(
            "INSERT INTO tblPersonal (PERSONAL_Nombre, PERSONAL_Puesto, PERSONAL_Titulo)
            VALUES (?, ?, ?)",
            [$values["nombre"], $values["puesto"], $values["titulo"]]
        );
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblPersonal SET PERSONAL_Archivado = ? WHERE PERSONALID = ?",
            [$state, $id]
        );
    }
}
