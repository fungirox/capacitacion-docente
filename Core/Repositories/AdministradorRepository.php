<?php

namespace Core\Repositories;

class AdministradorRepository extends RepositoryTemplate {
    
    public function getAllWithParams($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "usuario.USERID-DESC", $sortOrder = "ASC") {
        $allowedSortColumns = ['usuario.USERID', 'USER_NombreUsuario', 'USER_Nombre', 'USER_Apellido', 'USER_Email'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'usuario.USERID';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'ASC';

        $searchCondition = $search ? "AND (USER_NombreUsuario LIKE ? OR USER_Nombre + ' ' + USER_Apellido LIKE ? OR USER_Email LIKE ?)" : "";

        $params = [$archivado];

        if ($search) {
            $searchParam = "%$search%";
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        $countParams = [$archivado];
        if ($search) {
            $searchParam = "%{$search}%";
            $countParams[] = $searchParam;
            $countParams[] = $searchParam;
            $countParams[] = $searchParam;
        }

        $totalCount = $this->query(
            "SELECT COUNT(*) as total 
            FROM tblUsuario AS usuario
            INNER JOIN tblAdmin AS admin ON admin.USERID = usuario.USERID
            WHERE USER_Activo != ?
            $searchCondition",
            $countParams
        )->get()['total'];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalPages));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                usuario.USERID AS id,
                USER_NombreUsuario AS username,
                USER_Nombre + ' ' + USER_Apellido AS nombre,
                USER_Email AS email
            FROM tblUsuario AS usuario
            INNER JOIN tblAdmin AS admin ON admin.USERID = usuario.USERID
            WHERE USER_Activo != ?
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
}
