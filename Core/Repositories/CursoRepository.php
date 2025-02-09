<?php

namespace Core\Repositories;

use DateTime;

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
                curso.CURSOID AS id,
                curso.CURSO_Nombre AS nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad AS tipo,
                curso.CURSO_Estado AS estado,
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
                curso.CURSO_Estado,
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
                curso.CURSO_Estado = 'publico' OR
                curso.CURSO_Estado = 'en_progreso' AND
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
                    curso.CURSO_Estado = 'publico' AND
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
                curso.CURSO_Estado = 'publico' AND
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

    public function getAllTeaching($userId) {
        return $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                curso.CURSO_Estado as estado,
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
                curso.CURSO_Estado as estado
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS curso_instructor ON curso.CURSOID = curso_instructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = curso_instructor.INSTRUCTORID
            WHERE
                curso.CURSO_Archivado = 0 AND
                curso.CURSO_Estado = 'publico' OR
                curso.CURSO_Estado = 'en_progreso' AND
                instructor.USERID = ?
            ORDER BY
                curso.CURSOID DESC",
            [$userId]
        )->getAll();
    }

    public function getById($cursoId) {
        return $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Modalidad as modalidad,
                curso.CURSO_Estado AS estado,
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
                (
                    CASE
                        WHEN curso.CURSO_Perfil = 0
                        THEN 'Actualización profesional'
                        ELSE 'Formación docente'
                    END
                ) AS perfil,
                (
                    CASE
                        WHEN curso.CURSO_Externo = 0
                        THEN 'Servicio interno'
                        ELSE 'Servicio externo'
                    END
                ) AS origen,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                curso.CURSO_Limite as limite,
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
                curso.CURSO_Estado,
                curso.CURSO_Externo,
                curso.CURSO_Perfil,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                curso.CURSO_Limite,
                usuario.USER_Nombre,
                usuario.USER_Apellido",
            [$cursoId]
        )->getOrFail();
    }

    public function getByIdForEdit($cursoId) {
        return $this->query(
            "SELECT
                curso.CURSOID AS id,
                CURSO_Nombre AS nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                instructor.INSTRUCTORID AS instructor_id,
                (
                    SELECT STRING_AGG(CAST(AREAID AS VARCHAR), ',') WITHIN GROUP (ORDER BY AREAID)
                    FROM (
                        SELECT DISTINCT area.AREAID
                        FROM tblCursoArea AS cursoArea
                        JOIN tblArea AS area ON area.AREAID = cursoArea.AREAID
                        WHERE cursoArea.CURSOID = curso.CURSOID
                    ) AS distinct_areas
                ) AS areas,
                CURSO_Perfil AS perfil,
                CURSO_Modalidad AS modalidad,
                CURSO_Fecha_Inicio AS fecha_inicio,
                CURSO_Fecha_Final AS fecha_final,
                CURSO_Total_Horas AS horas_total,
                CURSO_Horas_Presenciales AS horas_presenciales,
                CURSO_Aula AS aula,
                (
                    SELECT STRING_AGG(HORARIOCURSO_Dia_Semana, ',') WITHIN GROUP (ORDER BY HORARIOCURSO_Dia_Semana)
                    FROM (
                        SELECT DISTINCT horario.HORARIOCURSO_Dia_Semana
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID
                    ) AS distinct_dias
                ) AS dias,
                CONVERT(
                    varchar(5), (
                        SELECT TOP 1 horario.HORARIOCURSO_Hora_Inicio
                        FROM tblHorarioCurso AS horario 
                        WHERE horario.CURSOID = curso.CURSOID), 
                        108
                    ) AS hora_inicial,
                CONVERT(
                    varchar(5), (
                        SELECT TOP 1 horario.HORARIOCURSO_Hora_Final 
                        FROM tblHorarioCurso AS horario
                        WHERE horario.CURSOID = curso.CURSOID),
                        108
                    ) AS hora_final,
                CURSO_Limite AS limite,
                CURSO_Externo AS externo
            FROM tblCurso as curso
            LEFT JOIN tblCursoInstructor AS instructor ON curso.CURSOID = instructor.CURSOID
            LEFT JOIN tblCursoArea AS curso_area ON curso_area.CURSOID = curso.CURSOID
            LEFT JOIN tblArea AS area ON area.AREAID = curso_area.AREAID
            WHERE curso.CURSOID = ?
            GROUP BY
                curso.CURSOID,
                CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                instructor.INSTRUCTORID,
                CURSO_Perfil,
                CURSO_Modalidad,
                CURSO_Fecha_Inicio,
                CURSO_Fecha_Final,
                CURSO_Total_Horas,
                CURSO_Horas_Presenciales,
                CURSO_Aula,
                CURSO_Limite,
                CURSO_Externo",
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
                (
                    CASE
                        WHEN curso.CURSO_Perfil = 0
                        THEN 'Actualización profesional'
                        ELSE 'Formación docente'
                    END
                ) AS perfil,
                (
                    CASE
                        WHEN curso.CURSO_Externo = 0
                        THEN 'Servicio interno'
                        ELSE 'Servicio externo'
                    END
                ) AS origen,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                curso.CURSO_Limite as limite,
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
                curso.CURSO_Estado = 'publico' OR
                curso.CURSO_Estado = 'en_progreso' AND
                curso.CURSO_Archivado = 0 AND
                usuario.USERID = ?
            GROUP BY
                curso_docente.CURSODOCENTEID,
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Externo,
                curso.CURSO_Perfil,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                curso.CURSO_Limite,
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
                (
                    CASE
                        WHEN curso.CURSO_Perfil = 0
                        THEN 'Actualización profesional'
                        ELSE 'Formación docente'
                    END
                ) AS perfil,
                (
                    CASE
                        WHEN curso.CURSO_Externo = 0
                        THEN 'Servicio interno'
                        ELSE 'Servicio externo'
                    END
                ) AS origen,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                curso.CURSO_Limite as limite,
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
                curso.CURSO_Estado = 'publico' AND
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
                curso.CURSO_Externo,
                curso.CURSO_Perfil,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                curso.CURSO_Limite,
                instructor_usuario.USER_Nombre,
                instructor_usuario.USER_Apellido",
            [$userId, $userId, $cursoId]
        )->getOrFail();
    }

    public function getAllTeachingById($cursoId, $userId) {
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
                (
                    CASE
                        WHEN curso.CURSO_Perfil = 0
                        THEN 'Actualización profesional'
                        ELSE 'Formación docente'
                    END
                ) AS perfil,
                (
                    CASE
                        WHEN curso.CURSO_Externo = 0
                        THEN 'Servicio interno'
                        ELSE 'Servicio externo'
                    END
                ) AS origen,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                curso.CURSO_Aula as aula,
                curso.CURSO_Limite as limite,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS curso_instructor ON curso.CURSOID = curso_instructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = curso_instructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            WHERE
                curso.CURSOID = ? AND
                curso.CURSO_Archivado = 0 AND
                curso.CURSO_Estado = 'publico' OR
                curso.CURSO_Estado = 'en_progreso' AND
                instructor.USERID = ?
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Externo,
                curso.CURSO_Perfil,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Aula,
                curso.CURSO_Limite,
                usuario.USER_Nombre,
                usuario.USER_Apellido",
            [$cursoId, $userId]
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

    public function getEvaluacion($cursoId, $userId) {
        return $this->query(
            "SELECT c.* FROM tblCurso c
                        JOIN tblCursoDocente cd ON c.CURSOID = cd.CURSOID
                        JOIN tblDocente d ON cd.DOCENTEID = d.DOCENTEID
                        JOIN tblUsuario u ON d.USERID = u.USERID
                        WHERE u.USERID = ?
                        AND c.CURSOID = ?
                        AND cd.CURSODOCENTE_EncuestaEvaluacion IS NULL
                        AND c.CURSO_En_Progreso = 0
                        AND c.CURSO_Archivado = 0
                        AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId, $cursoId]
        )->getOrFail();
    }

    public function getEficacia($cursoId, $userId) {
        return $this->query(
            "SELECT c.* FROM tblCurso c
                        JOIN tblCursoDocente cd ON c.CURSOID = cd.CURSOID
                        JOIN tblDocente d ON cd.DOCENTEID = d.DOCENTEID
                        JOIN tblUsuario u ON d.USERID = u.USERID
                        WHERE u.USERID = ?
                        AND c.CURSOID = ?
                        AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
                        AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
                        AND c.CURSO_En_Progreso = 0
                        AND c.CURSO_Archivado = 0
                        AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId, $cursoId]
        )->getOrFail();
    }

    public function getCursosNoEvaluados($userId) {
        return $this->query(
            "SELECT c.CURSOID, c.CURSO_Nombre
            FROM tblUsuario u
            JOIN tblDocente d ON u.USERID = d.USERID
            JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
            JOIN tblCurso c ON cd.CURSOID = c.CURSOID
            WHERE u.USERID = ?
            AND cd.CURSODOCENTE_EncuestaEvaluacion IS NULL
            AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
            AND c.CURSO_En_Progreso = 0
            AND c.CURSO_Archivado = 0
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosSinEficacia($userId) {
        return $this->query(
            "SELECT 
                c.CURSOID,
                c.CURSO_Nombre
            FROM tblUsuario u
            JOIN tblDocente d ON u.USERID = d.USERID
            JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
            JOIN tblCurso c ON cd.CURSOID = c.CURSOID
            WHERE u.USERID = ?
            AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
            AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
            AND c.CURSO_En_Progreso = 0
            AND c.CURSO_Archivado = 0
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosConcluidos($userId) {
        return $this->query(
            "SELECT 
                c.CURSOID,
                c.CURSO_Nombre
            FROM tblUsuario u
            JOIN tblDocente d ON u.USERID = d.USERID
            JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
            JOIN tblCurso c ON cd.CURSOID = c.CURSOID
            WHERE u.USERID = ?
            AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
            AND cd.CURSODOCENTE_EncuestaEficacia = 1
            AND c.CURSO_En_Progreso = 0
            AND c.CURSO_Archivado = 0
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosSinEficaciaAdmin() {
        return $this->query("SELECT 
            c.CURSOID, 
            c.CURSO_Nombre
        FROM 
            tblCurso c
        JOIN 
            tblCursoDocente cd ON c.CURSOID = cd.CURSOID
        WHERE 
            cd.CURSODOCENTE_EncuestaEvaluacion = 1
            AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
            AND cd.CURSODOCENTE_Calificacion > 0
        GROUP BY 
            c.CURSOID, c.CURSO_Nombre")->getAll();
    }

    public function getCursosConcluidosAdmin() {
        return $this->query("SELECT 
                c.CURSOID, 
                c.CURSO_Nombre
            FROM 
                tblCurso c
            JOIN 
                tblCursoDocente cd ON c.CURSOID = cd.CURSOID
            WHERE 
                cd.CURSODOCENTE_EncuestaEvaluacion = 1
                AND cd.CURSODOCENTE_EncuestaEficacia = 1
                AND cd.CURSODOCENTE_Calificacion > 0
            GROUP BY 
                c.CURSOID, c.CURSO_Nombre")->getAll();
    }

    public function getCursoConcluido($cursoId) {
        return $this->query(
            "SELECT 
                c.CURSOID, 
                c.CURSO_Nombre
            FROM 
                tblCurso c
            JOIN 
                tblCursoDocente cd ON c.CURSOID = cd.CURSOID
            WHERE 
                cd.CURSODOCENTE_EncuestaEvaluacion = 1
                AND cd.CURSODOCENTE_EncuestaEficacia = 1
                AND cd.CURSODOCENTE_Calificacion > 0
                AND c.CURSOID = ?
            GROUP BY 
                c.CURSOID, c.CURSO_Nombre",
            [$cursoId]
        )->getOrFail();
    }

    public function getCursoEvaluado($cursoId) {
        return $this->query(
            "SELECT 
                c.CURSOID, 
                c.CURSO_Nombre,
                c.CURSO_Modalidad
            FROM 
                tblCurso c
            JOIN 
                tblCursoDocente cd ON c.CURSOID = cd.CURSOID
            WHERE 
                cd.CURSODOCENTE_EncuestaEvaluacion = 1
                AND cd.CURSODOCENTE_Calificacion > 0
                AND c.CURSOID = ?
            GROUP BY 
                c.CURSOID, c.CURSO_Nombre, c.CURSO_Modalidad",
            [$cursoId]
        )->getOrFail();
    }

    public function getCursoConstancia($userId, $cursoId) {
        return $this->query(
            "SELECT c.CURSOID,c.CURSO_Nombre,c.CURSO_Fecha_Final,CURSO_Tipo FROM tblCurso c
            JOIN tblCursoDocente cd ON c.CURSOID = cd.CURSOID
            JOIN tblDocente d ON cd.DOCENTEID = d.DOCENTEID
            JOIN tblUsuario u ON d.USERID = u.USERID
            WHERE u.USERID = ?
            AND c.CURSOID = ?
            AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
            AND c.CURSO_Archivado = 0
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId, $cursoId]
        )->getOrFail();
    }

    public function getAllReporteTECNM() {
        return $this->query(
            "SELECT
            curso.CURSOID,
            curso.CURSO_Nombre,
            curso.CURSO_Tipo AS tipo,
            CASE 
                WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 1 AND MONTH(curso.CURSO_Fecha_Final) <= 5 THEN 
                    'Enero-Mayo ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 6 AND MONTH(curso.CURSO_Fecha_Final) <= 7 THEN 
                    'Verano ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 8 AND MONTH(curso.CURSO_Fecha_Final) <= 12 THEN 
                    'Agosto-Diciembre ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                ELSE 'Otro periodo'
            END AS Periodo,
            curso.CURSO_Activo,
            curso.CURSO_Perfil,
            curso.CURSO_Modalidad,
            usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre,
            COUNT(DISTINCT CASE WHEN usuario.USER_Genero = 0 AND cursoDocente.CURSODOCENTE_Calificacion > 70  THEN docente.DOCENTEID END) AS cantidad_docentes_masculinos,
            COUNT(DISTINCT CASE WHEN usuario.USER_Genero = 1 AND cursoDocente.CURSODOCENTE_Calificacion > 70  THEN docente.DOCENTEID END) AS cantidad_docentes_femeninos,
            COUNT(DISTINCT CASE WHEN cursoDocente.CURSODOCENTE_Calificacion > 70 THEN docente.DOCENTEID END) AS cantidad_docentes_total
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
            tblCursoDocente AS cursoDocente ON curso.CURSOID = cursoDocente.CURSOID
        LEFT JOIN
            tblDocente AS docente ON cursoDocente.DOCENTEID = docente.DOCENTEID
        LEFT JOIN
            tblUsuario AS usuarioDocente ON docente.USERID = usuarioDocente.USERID
        GROUP BY
            curso.CURSOID,
            curso.CURSO_Nombre,
            curso.CURSO_Tipo,
            curso.CURSO_Activo,
            curso.CURSO_Perfil,
            curso.CURSO_Modalidad,
            usuario.USER_Nombre,
            curso.CURSO_Fecha_Inicio,
            curso.CURSO_Fecha_Final,
            usuario.USER_Apellido;"
        )->getAll();
    }

    public function getAllReporteITESCA() {
        return $this->query(
            "SELECT
                curso.CURSOID,
                curso.CURSO_Nombre,
                CASE 
                    WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 1 AND MONTH(curso.CURSO_Fecha_Final) <= 5 THEN 
                        'Enero-Mayo ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                    WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 6 AND MONTH(curso.CURSO_Fecha_Final) <= 7 THEN 
                        'Verano ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                    WHEN MONTH(curso.CURSO_Fecha_Inicio) >= 8 AND MONTH(curso.CURSO_Fecha_Final) <= 12 THEN 
                        'Agosto-Diciembre ' + CAST(YEAR(curso.CURSO_Fecha_Inicio) AS VARCHAR)
                    ELSE 'Otro periodo'
                END AS Periodo,
                COUNT(DISTINCT CASE WHEN cursoDocente.CURSODOCENTE_Calificacion > 70 THEN docente.DOCENTEID END) AS cantidad_docentes_total,
                AVG(COALESCE(cursoDocente.CURSODOCENTE_Calificacion, 0)) AS promedio_calificacion,
                curso.CURSO_Total_Horas AS total_horas
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
                tblCursoDocente AS cursoDocente ON curso.CURSOID = cursoDocente.CURSOID
            LEFT JOIN
                tblDocente AS docente ON cursoDocente.DOCENTEID = docente.DOCENTEID
            LEFT JOIN
                tblUsuario AS usuarioDocente ON docente.USERID = usuarioDocente.USERID
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Activo,
                curso.CURSO_Perfil,
                curso.CURSO_Modalidad,
                usuario.USER_Nombre,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                curso.CURSO_Total_Horas,
                usuario.USER_Apellido;"
        )->getAll();
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

    public function addServicio($attributes) {
        switch ($attributes["modalidad"]) {
            case "presencial":
                $this->addServicioPresencial($attributes);
                break;
            case "mixto":
                $this->addServicioMixto($attributes);
                break;
            case "virtual":
                $this->addServicioVirtual($attributes);
                break;
        }

        $cursoId = $this->getDatabase()->lastInsertId();

        $this->addCursoInstructor($cursoId, $attributes["instructor"]);
        $this->addCursoArea($cursoId, $attributes["areas"]);

        if (strcmp($attributes["modalidad"], "virtual") !== 0) {
            $this->addCursoSchedule(
                $cursoId,
                $attributes["dias"],
                $attributes["horaInicial"],
                $attributes["horaFinal"]
            );
        }

        return $cursoId;
    }

    private function addServicioPresencial($attributes) {
        extract($attributes);

        $this->query(
            "INSERT INTO tblCurso (
                CURSO_Tipo,
                CURSO_Nombre,
                CURSO_Descripcion,
                CURSO_Perfil,
                CURSO_Modalidad,
                CURSO_Fecha_Inicio,
                CURSO_Fecha_Final,
                CURSO_Total_Horas,
                CURSO_Aula,
                CURSO_Limite,
                CURSO_Externo
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$tipo, $nombre, $descripcion, $perfil, $modalidad, $fechaInicial, $fechaFinal, $horasTotal, $aula, $limite, $externo]
        );
    }

    private function addServicioMixto($attributes) {
        extract($attributes);

        $this->query(
            "INSERT INTO tblCurso (
                CURSO_Tipo,
                CURSO_Nombre,
                CURSO_Descripcion,
                CURSO_Perfil,
                CURSO_Modalidad,
                CURSO_Fecha_Inicio,
                CURSO_Fecha_Final,
                CURSO_Total_Horas,
                CURSO_Horas_Presenciales,
                CURSO_Aula,
                CURSO_Limite,
                CURSO_Externo
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$tipo, $nombre, $descripcion, $perfil, $modalidad, $fechaInicial, $fechaFinal, $horasTotal, $horasPresenciales, $aula, $limite, $externo]
        );
    }

    private function addServicioVirtual($attributes) {
        extract($attributes);

        $this->query(
            "INSERT INTO tblCurso (
                CURSO_Tipo,
                CURSO_Nombre,
                CURSO_Descripcion,
                CURSO_Perfil,
                CURSO_Modalidad,
                CURSO_Fecha_Inicio,
                CURSO_Fecha_Final,
                CURSO_Total_Horas,
                CURSO_Externo
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$tipo, $nombre, $descripcion, $perfil, $modalidad, $fechaInicial, $fechaFinal, $horasTotal, $externo]
        );
    }

    private function addCursoInstructor($cursoId, $instructorId) {
        $this->query(
            "INSERT INTO tblCursoInstructor (CURSOID, INSTRUCTORID) VALUES (?, ?)",
            [$cursoId, $instructorId]
        );
    }

    private function addCursoArea($cursoId, $areas) {
        $placeholders = implode(',', array_fill(0, count($areas), '(?, ?)'));

        $params = [];
        foreach ($areas as $areaId) {
            $params[] = $cursoId;
            $params[] = $areaId;
        }

        $this->query("INSERT INTO tblCursoArea (CURSOID, AREAID) VALUES $placeholders", $params);
    }

    private function addCursoSchedule($cursoId, $dias, $horaInicial, $horaFinal) {
        $placeholders = implode(',', array_fill(0, count($dias), '(?, ?, ?, ?, ?)'));

        $params = [];
        foreach ($dias as $dia) {
            $params[] = $cursoId;
            $params[] = $dia;
            $params[] = $horaInicial;
            $params[] = $horaFinal;
            $params[] = (new DateTime($horaFinal))->diff(new DateTime($horaInicial))->h;
        }

        $this->query(
            "INSERT INTO tblHorarioCurso
                (CURSOID, HORARIOCURSO_Dia_Semana, HORARIOCURSO_Hora_Inicio, HORARIOCURSO_Hora_Final, HORARIOCURSO_Horas)
            VALUES $placeholders",
            $params
        );
    }
}
