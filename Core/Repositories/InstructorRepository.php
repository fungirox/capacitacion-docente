<?php

namespace Core\Repositories;

class InstructorRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT 
                INSTRUCTORID as id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblInstructor AS instructor
            LEFT JOIN tblUsuario AS usuario ON instructor.USERID = usuario.USERID
            WHERE USER_Activo = 1
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC"
        )->getAll();
    }

    public function getAllIds($instructorId) {
        return $this->query(
            "SELECT 
                INSTRUCTORID as id
            FROM tblInstructor AS instructor
            LEFT JOIN tblUsuario AS usuario ON instructor.USERID = usuario.USERID
            WHERE USER_Activo = 1 AND
            INSTRUCTORID = ?
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC",
            [$instructorId]
        )->getAll();
    }

    public function getAllWithParams($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "usuario.USERID-DESC", $sortOrder = "ASC") {
        $allowedSortColumns = ['usuario.USERID', 'USER_NombreUsuario', 'USER_Nombre', 'USER_Apellido', 'USER_Email'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'usuario.USERID';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'DESC';

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
            INNER JOIN tblInstructor AS instructor ON instructor.USERID = usuario.USERID
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
                USER_Email AS email,
                INSTRUCTOR_Estudios AS estudios
            FROM tblUsuario AS usuario
            INNER JOIN tblInstructor AS instructor ON instructor.USERID = usuario.USERID
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

    public function getById($id) {
        return $this->query(
            "SELECT
                usuario.USERID AS id,
                USER_Nombre AS nombre,
                USER_Apellido AS apellido,
                USER_NombreUsuario AS username,
                USER_Email AS email,
                USER_Genero AS genero,
                INSTRUCTOR_Estudios AS estudios
            FROM tblUsuario AS usuario
            INNER JOIN tblInstructor AS instructor ON instructor.USERID = usuario.USERID
            WHERE usuario.USERID = ?",
            [$id]
        )->get();
    }

    public function create($attributes) {
        $this->query(
            "INSERT INTO tblUsuario (USER_NombreUsuario, USER_Nombre, USER_Apellido, USER_Email, USER_Genero, USER_Password, USER_Activo)
            VALUES (?, ?, ?, ?, ?, ?, 1)",
            [
                $attributes["username"],
                $attributes["nombre"],
                $attributes["apellido"],
                $attributes["email"],
                $attributes["genero"],
                password_hash($attributes["password"], PASSWORD_BCRYPT)
            ]
        );

        $userId = $this->getDatabase()->lastInsertId();

        return $this->query(
            "INSERT INTO tblInstructor (USERID, INSTRUCTOR_Estudios) VALUES (?, ?)",
            [$userId, $attributes["estudios"]]
        );
    }

    public function update($attributes) {
        if ($attributes["updatePassword"]) {
            $this->query(
                "UPDATE tblUsuario
                SET USER_Nombre = ?,
                    USER_Apellido = ?,
                    USER_NombreUsuario = ?,
                    USER_Email = ?,
                    USER_Genero = ?,
                    USER_Password = ?
                WHERE USERID = ?",
                [
                    $attributes["nombre"],
                    $attributes["apellido"],
                    $attributes["username"],
                    $attributes["email"],
                    $attributes["genero"],
                    password_hash($attributes["password"], PASSWORD_BCRYPT),
                    $attributes["id"]
                ]
            );
        } else {
            $this->query(
                "UPDATE tblUsuario
                SET USER_Nombre = ?,
                    USER_Apellido = ?,
                    USER_NombreUsuario = ?,
                    USER_Email = ?,
                    USER_Genero = ?
                WHERE USERID = ?",
                [
                    $attributes["nombre"],
                    $attributes["apellido"],
                    $attributes["username"],
                    $attributes["email"],
                    $attributes["genero"],
                    $attributes["id"]
                ]
            );
        }

        return $this->query(
            "UPDATE tblInstructor
            SET INSTRUCTOR_Estudios = ?
            WHERE USERID = ?",
            [$attributes["estudios"], $attributes["id"]]
        );
    }
}
