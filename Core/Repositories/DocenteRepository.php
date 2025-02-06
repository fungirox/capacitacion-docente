<?php

namespace Core\Repositories;

use Core\Roles\Roles;

class DocenteRepository extends RepositoryTemplate {

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
            INNER JOIN tblDocente AS docente ON docente.USERID = usuario.USERID
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
                CASE
                    WHEN EXISTS (
                        SELECT 1
                        FROM tblInstructor
                        WHERE USERID = usuario.USERID
                    ) THEN 'Instructor'
                    ELSE ''
                END AS es_instructor,
                CASE
                    WHEN DOCENTE_Base = 1
                    THEN DOCENTE_Horas_Base
                    ELSE 0
                END AS horas_base,
                USER_Email AS email
            FROM tblUsuario AS usuario
            INNER JOIN tblDocente AS docente ON docente.USERID = usuario.USERID
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

    public function getAll() {
        return $this->query(
            "SELECT
                DOCENTEID as id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblDocente AS docente
            LEFT JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE USER_Activo = 1
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC"
        )->getAll();
    }

    public function getDocenteId($userId) {
        return $this->query(
            "SELECT d.DOCENTEID
                FROM tblUsuario u
                JOIN tblDocente d ON u.USERID = d.USERID
                WHERE u.USERID = ?",
            [$userId]
        )->get();
    }

    public function getById($id) {
        return $this->query(
            "SELECT
                usuario.USERID AS id,
                INSTRUCTORID AS instructorId,
                DOCENTEID AS docenteId,
                USER_Nombre AS nombre,
                USER_Apellido AS apellido,
                USER_NombreUsuario AS username,
                USER_Email AS email,
                USER_Genero AS genero,
                DOCENTE_Base AS baseHoras,
                DOCENTE_Horas_Base AS horasBase,
                INSTRUCTOR_Estudios AS estudios,
                CASE
                    WHEN INSTRUCTORID > 0 THEN 1
                    ELSE 0
                END AS 'docenteInstructor'
            FROM tblUsuario AS usuario
                LEFT JOIN tblInstructor AS instructor ON usuario.USERID = instructor.USERID
                RIGHT JOIN tblDocente AS docente ON usuario.USERID = docente.USERID
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

        $this->query(
            "INSERT INTO tblDocente (USERID, DOCENTE_Nomina, DOCENTE_Base, DOCENTE_Horas_Base)
            VALUES (?, ?, ?, ?)",
            [$userId, $attributes["username"], $attributes["baseHoras"], $attributes["horasBase"]]
        );

        if ($attributes["docenteInstructor"] == 1) {
            return $this->query(
                "INSERT INTO tblInstructor (USERID, INSTRUCTOR_Estudios) VALUES (?, ?)",
                [$userId, $attributes["estudios"]]
            );
        }
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

        if ($attributes["isDocenteInstructor"] == 1) {
            $this->query(
                "UPDATE tblInstructor
                SET INSTRUCTOR_Estudios = ?
                WHERE USERID = ?",
                [$attributes["estudios"], $attributes["id"]]
            );
        }

        if ($attributes["isDocenteInstructor"] == 0 && $attributes["docenteInstructor"] == 1) {
            $this->query(
                "INSERT INTO tblInstructor (USERID, INSTRUCTOR_Estudios) VALUES (?, ?)",
                [$attributes["id"], $attributes["estudios"]]
            );
        }

        return $this->query(
            "UPDATE tblDocente
            SET DOCENTE_Nomina = ?,
                DOCENTE_Base = ?,
                DOCENTE_Horas_Base = ?
            WHERE USERID = ?",
            [$attributes["username"], $attributes["baseHoras"], $attributes["horasBase"], $attributes["id"]]
        );
    }
}
