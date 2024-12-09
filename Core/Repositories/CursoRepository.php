<?php

namespace Core\Repositories;

class CursoRepository extends RepositoryTemplate
{

    public function getAll()
    {
        return $this->query(
            "SELECT
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Activo,
                STRING_AGG(area.AREA_Siglas, ',') AS areas,
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
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Activo,
                usuario.USER_Nombre,
                usuario.USER_Apellido"
        )->getAll();
    }

    public function getById($cursoId)
    {
        return $this->query(
            "SELECT
                curso.CURSOID as id,
                curso.CURSO_Nombre as nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)) as descripcion,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                STRING_AGG(area.AREA_Siglas, ',') AS areas,
                curso.CURSO_Total_Horas as duracion,
                curso.CURSO_Fecha_Inicio as inicio,
                curso.CURSO_Fecha_Final as final,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor
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
                curso.CURSOID = ? AND
                curso.CURSO_Activo = 1
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                CAST(curso.CURSO_Descripcion AS VARCHAR(MAX)),
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Fecha_Inicio,
                curso.CURSO_Fecha_Final,
                usuario.USER_Nombre,
                usuario.USER_Apellido;",
            [$cursoId]
        )->getOrFail();
    }

    public function getEvaluacion($cursoId, $userId)
    {
        return $this->query(
            "SELECT c.* FROM tblCurso c
                        JOIN tblCursoDocente cd ON c.CURSOID = cd.CURSOID
                        JOIN tblDocente d ON cd.DOCENTEID = d.DOCENTEID
                        JOIN tblUsuario u ON d.USERID = u.USERID
                        WHERE u.USERID = ?
                        AND c.CURSOID = ?
                        AND cd.CURSODOCENTE_EncuestaEvaluacion IS NULL
                        AND c.CURSO_Activo = 0
                        AND c.CURSO_En_Progreso = 0
                        AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId, $cursoId]
        )->getOrFail();
    }

    public function getEficacia($cursoId, $userId)
    {
        return $this->query(
            "SELECT c.* FROM tblCurso c
                        JOIN tblCursoDocente cd ON c.CURSOID = cd.CURSOID
                        JOIN tblDocente d ON cd.DOCENTEID = d.DOCENTEID
                        JOIN tblUsuario u ON d.USERID = u.USERID
                        WHERE u.USERID = ?
                        AND c.CURSOID = ?
                        AND cd.CURSODOCENTE_EncuestaEvaluacion = 1
                        AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
                        AND c.CURSO_Activo = 0
                        AND c.CURSO_En_Progreso = 0
                        AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId, $cursoId]
        )->getOrFail();
    }

    public function getCursosNoEvaluados($userId)
    {
        return $this->query(
            "SELECT c.CURSOID, c.CURSO_Nombre
            FROM tblUsuario u
            JOIN tblDocente d ON u.USERID = d.USERID
            JOIN tblCursoDocente cd ON d.DOCENTEID = cd.DOCENTEID
            JOIN tblCurso c ON cd.CURSOID = c.CURSOID
            WHERE u.USERID = ?
            AND cd.CURSODOCENTE_EncuestaEvaluacion IS NULL
            AND cd.CURSODOCENTE_EncuestaEficacia IS NULL
            AND c.CURSO_Activo = 0
            AND c.CURSO_En_Progreso = 0
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosSinEficacia($userId)
    {
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
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosConcluidos($userId)
    {
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
            AND cd.CURSODOCENTE_Calificacion > 0;",
            [$userId]
        )->getAll();
    }

    public function getCursosSinEficaciaAdmin()
    {
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

    public function getCursosConcluidosAdmin()
    {
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

    public function getCursoConcluido($cursoId)
    {
        return $this->query("SELECT 
            c.CURSOID, 
            c.CURSO_Nombre,
            c.CURSO_Modalidad
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
            c.CURSOID, c.CURSO_Nombre, c.CURSO_Modalidad", [$cursoId])->getOrFail();
    }

    public function getAllReporte()
    {
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
}
