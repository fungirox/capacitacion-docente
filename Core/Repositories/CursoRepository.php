<?php

namespace Core\Repositories;

class CursoRepository extends RepositoryTemplate {

    public function getAll($archivado = 0, $page = 1, $limit = 15, $search = "", $sortBy = "CURSOID", $sortOrder = "DESC", $filterBy = null) {
        $allowedSortColumns = ['CURSOID', 'CURSO_Nombre'];
        $allowedModalidades = ['virtual', 'hibrido', 'presencial'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? 'curso.' . $sortBy : 'curso.CURSOID';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'DESC';

        $searchCondition = $search ? "AND (curso.CURSO_Nombre LIKE ? OR usuario.USER_Nombre + ' ' + usuario.USER_Apellido LIKE ?)" : "";

        $modalidadCondition = "";
        if ($filterBy && in_array(strtolower($filterBy), $allowedModalidades)) {
            $modalidadCondition = "AND LOWER(curso.CURSO_Modalidad) = ?";
        }

        $params = [$archivado];

        if ($search) {
            $searchParam = "%$search%";
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        if ($filterBy && in_array(strtolower($filterBy), $allowedModalidades)) {
            $params[] = strtolower($filterBy);
        }

        $countParams = $params;

        $totalCount = $this->query(
            "SELECT COUNT(*) AS total
            FROM tblCurso AS curso
            LEFT JOIN tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            WHERE curso.CURSO_Archivado = ?
            $searchCondition
            $modalidadCondition",
            $countParams
        )->get()["total"];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalCount));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            LEFT JOIN
                tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
            LEFT JOIN
                tblArea AS area ON area.AREAID = cursoArea.AREAID
            WHERE curso.CURSO_Archivado = ?
            $searchCondition
            $modalidadCondition
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                usuario.USER_Nombre,
                usuario.USER_Apellido
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

    public function getAllSubscribed($userId) {
        return $this->query(
            "SELECT
                curso_docente.CURSODOCENTEID,
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                (
                    SELECT STRING_AGG(HORARIOCURSO_Dia_Semana, ',') WITHIN GROUP (ORDER BY HORARIOCURSO_Dia_Semana)
                    FROM (
                        SELECT DISTINCT horario.HORARIOCURSO_Dia_Semana
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID
                    ) AS distinct_dias
                ) AS dias,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Inicio
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_inicial,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Final
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_final,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                instructor_usuario.USER_Nombre + ' ' + instructor_usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            INNER JOIN
                tblCursoDocente AS curso_docente ON curso.CURSOID = curso_docente.CURSOID
            INNER JOIN
                tblDocente AS docente ON docente.DOCENTEID = curso_docente.DOCENTEID
            INNER JOIN
                tblUsuario AS usuario ON usuario.USERID = docente.USERID
            LEFT JOIN
                tblCursoInstructor AS curso_instructor ON curso.CURSOID = curso_instructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = curso_instructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS instructor_usuario ON instructor_usuario.USERID = instructor.USERID
            WHERE
                curso.CURSO_Activo = 1 AND
                curso.CURSO_Archivado = 0 AND
                usuario.USERID = ?
            GROUP BY
                curso_docente.CURSODOCENTEID,
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                instructor_usuario.USER_Nombre,
                instructor_usuario.USER_Apellido
            ORDER BY
                curso_docente.CURSODOCENTEID DESC",
            [$userId]
        )->getAll();
    }

    public function getAllUnsubscribed($page = 1, $limit = 15, $search = "", $sortBy = "CURSOID", $sortOrder = "DESC", $filterBy = null, $userId) {
        $allowedSortColumns = ['CURSOID', 'CURSO_Nombre'];
        $allowedModalidades = ['virtual', 'hibrido', 'presencial'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? 'curso.' . $sortBy : 'curso.CURSOID';
        $sortOrder = in_array($sortOrder, $this->validOrders) ? $sortOrder : 'DESC';

        $searchCondition = $search ? "AND (curso.CURSO_Nombre LIKE ? OR usuario.USER_Nombre + ' ' + usuario.USER_Apellido LIKE ?)" : "";

        $modalidadCondition = "";
        if ($filterBy && in_array(strtolower($filterBy), $allowedModalidades)) {
            $modalidadCondition = "AND LOWER(curso.CURSO_Modalidad) = ?";
        }

        $params = [$userId];
        $params[] = $userId;

        if ($search) {
            $searchParam = "%$search%";
            $params[] = $searchParam;
            $params[] = $searchParam;
        }

        if ($filterBy && in_array(strtolower($filterBy), $allowedModalidades)) {
            $params[] = strtolower($filterBy);
        }

        $countParams = $params;

        $totalCount = $this->query(
            "SELECT COUNT(*) AS total
            FROM (
                SELECT DISTINCT
                    curso.CURSOID as id
                FROM
                    tblCurso AS curso
                LEFT JOIN
                    tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
                LEFT JOIN
                    tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
                LEFT JOIN
                    tblUsuario AS usuario ON usuario.USERID = instructor.USERID
                LEFT JOIN
                    tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
                LEFT JOIN
                    tblArea AS area ON area.AREAID = cursoArea.AREAID
                LEFT JOIN
                    tblCursoDocente AS curso_docente ON curso.CURSOID = curso_docente.CURSOID
                    AND curso_docente.DOCENTEID IN (
                        SELECT DOCENTEID
                        FROM tblDocente
                        WHERE USERID = ?
                    )
                WHERE
                    instructor.USERID != ? AND
                    curso.CURSO_Activo = 1 AND
                    curso.CURSO_En_Progreso = 0 AND
                    curso.CURSO_Archivado = 0 AND
                    curso_docente.CURSOID IS NULL
                    $searchCondition
                    $modalidadCondition
            ) as subquery",
            $countParams
        )->get()["total"];

        $totalPages = max(1, ceil($totalCount / $limit));

        $page = max(1, min($page, $totalCount));

        $params[] = $this->getOffset($page, $limit);
        $params[] = $limit;

        $results = $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            LEFT JOIN
                tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
            LEFT JOIN
                tblArea AS area ON area.AREAID = cursoArea.AREAID
            LEFT JOIN
                tblCursoDocente AS curso_docente ON curso.CURSOID = curso_docente.CURSOID
                AND curso_docente.DOCENTEID IN (
                    SELECT DOCENTEID
                    FROM tblDocente
                    WHERE USERID = ?
                )
            WHERE
                instructor.USERID != ? AND
                curso.CURSO_Activo = 1 AND
                curso.CURSO_En_Progreso = 0 AND
                curso.CURSO_Archivado = 0 AND
                curso_docente.CURSOID IS NULL
                $searchCondition
                $modalidadCondition
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                usuario.USER_Nombre,
                usuario.USER_Apellido
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

    public function getById($cursoId) {
        return $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                (
                    SELECT STRING_AGG(HORARIOCURSO_Dia_Semana, ',') WITHIN GROUP (ORDER BY HORARIOCURSO_Dia_Semana)
                    FROM (
                        SELECT DISTINCT horario.HORARIOCURSO_Dia_Semana
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID
                    ) AS distinct_dias
                ) AS dias,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Inicio
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_inicial,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Final
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_final,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            LEFT JOIN
                tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
            LEFT JOIN
                tblArea AS area ON area.AREAID = cursoArea.AREAID
            WHERE
                curso.CURSOID = ?
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                usuario.USER_Nombre,
                usuario.USER_Apellido",
            [$cursoId]
        )->getOrFail();
    }

    public function getSubscribedById($cursoId, $userId) {
        return $this->query(
            "SELECT
                curso_docente.CURSODOCENTEID,
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                (
                    SELECT STRING_AGG(HORARIOCURSO_Dia_Semana, ',') WITHIN GROUP (ORDER BY HORARIOCURSO_Dia_Semana)
                    FROM (
                        SELECT DISTINCT horario.HORARIOCURSO_Dia_Semana
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID
                    ) AS distinct_dias
                ) AS dias,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Inicio
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_inicial,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Final
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_final,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                instructor_usuario.USER_Nombre + ' ' + instructor_usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            INNER JOIN
                tblCursoDocente AS curso_docente ON curso.CURSOID = curso_docente.CURSOID
            INNER JOIN
                tblDocente AS docente ON docente.DOCENTEID = curso_docente.DOCENTEID
            INNER JOIN
                tblUsuario AS usuario ON usuario.USERID = docente.USERID
            LEFT JOIN
                tblCursoInstructor AS curso_instructor ON curso.CURSOID = curso_instructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = curso_instructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS instructor_usuario ON instructor_usuario.USERID = instructor.USERID
            WHERE
                curso.CURSOID = ? AND
                curso.CURSO_Activo = 1 AND
                curso.CURSO_Archivado = 0 AND
                usuario.USERID = ?
            GROUP BY
                curso_docente.CURSODOCENTEID,
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                instructor_usuario.USER_Nombre,
                instructor_usuario.USER_Apellido",
            [$cursoId, $userId]
        )->getOrFail();
    }

    public function getUnsubscribedById($cursoId, $userId) {
        return $this->query(
            "SELECT
                curso_docente.CURSODOCENTEID,
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                (
                    SELECT STRING_AGG(AREA_Siglas, ',') WITHIN GROUP (ORDER BY AREA_Siglas)
                    FROM (
                        SELECT DISTINCT area.AREA_Siglas
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                (
                    SELECT STRING_AGG(HORARIOCURSO_Dia_Semana, ',') WITHIN GROUP (ORDER BY HORARIOCURSO_Dia_Semana)
                    FROM (
                        SELECT DISTINCT horario.HORARIOCURSO_Dia_Semana
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID
                    ) AS distinct_dias
                ) AS dias,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Inicio
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_inicial,
                (
                    SELECT TOP 1 horario.HORARIOCURSO_Hora_Final
                    FROM tblHorarioCurso AS horario
                    WHERE horario.CURSOID = curso.CURSOID
                ) AS hora_final,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                instructor_usuario.USER_Nombre + ' ' + instructor_usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS curso_instructor ON curso.CURSOID = curso_instructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = curso_instructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS instructor_usuario ON instructor_usuario.USERID = instructor.USERID
            LEFT JOIN
                tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
            LEFT JOIN
                tblArea AS area ON area.AREAID = cursoArea.AREAID
            LEFT JOIN
                tblCursoDocente AS curso_docente ON curso.CURSOID = curso_docente.CURSOID
                AND curso_docente.DOCENTEID IN (
                    SELECT DOCENTEID
                    FROM tblDocente
                    WHERE USERID = ?
                )
            WHERE
                instructor.USERID != ? AND
                curso.CURSO_Activo = 1 AND
                curso.CURSO_En_Progreso = 0 AND
                curso.CURSO_Archivado = 0 AND
                curso_docente.CURSOID IS NULL AND
                curso.CURSOID = ?
            GROUP BY
                curso_docente.CURSODOCENTEID,
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                instructor_usuario.USER_Nombre,
                instructor_usuario.USER_Apellido",
            [$userId, $userId, $cursoId]
        )->getOrFail();
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblCurso SET CURSO_Archivado = ? WHERE CURSOID = ?",
            [$state, $id]
        );
    }

    public function getSubscription($cursoId, $userId) {
        return $this->query(
            "SELECT
                CURSODOCENTEID
            FROM
                tblCursoDocente AS curso_docente
            LEFT JOIN
                tblDocente AS docente ON curso_docente.DOCENTEID = docente.DOCENTEID
            WHERE
                curso_docente.CURSOID = ? AND
                docente.USERID = ?",
            [$cursoId, $userId]
        )->get();
    }

    public function subscribe($cursoId, $userId) {
        return $this->query(
            "INSERT INTO tblCursoDocente (CURSOID, DOCENTEID, CURSODOCENTE_Calificacion)
            VALUES (
                ?,
                (SELECT docente.DOCENTEID
                FROM tblDocente as docente
                WHERE USERID = ?),
                ?
            )",
            [$cursoId, $userId, 100]
        );
    }

    public function unsubscribe($cursoDocenteId) {
        return $this->query(
            "DELETE FROM tblCursoDocente
            WHERE CURSODOCENTEID = ?",
            [$cursoDocenteId]
        );
    }
}
