<?php

namespace Core\Repositories;

class CursoDocenteRepository extends RepositoryTemplate {

    public function getDocentesFromCurso($cursoId) {
        return $this->query(
            "SELECT
                docente.DOCENTEID AS id,
                USER_Nombre + ' ' + USER_Apellido AS nombre,
                0 AS presente
            FROM tblCursoDocente AS curso_docente
            INNER JOIN tblDocente AS docente ON curso_docente.DOCENTEID = docente.DOCENTEID
            INNER JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE curso_docente.CURSOID = ? 
            ORDER BY nombre ASC",
            [$cursoId]
        )->getAll();
    }

    public function getDocentesFromPreviousCurso($cursoId, $date) {
        return $this->query(
            "SELECT
                docente.DOCENTEID AS id,
                USER_Nombre + ' ' + USER_Apellido AS nombre,
                CASE
                    WHEN EXISTS (
                        SELECT *
                        FROM tblAsistenciaCurso AS asistencia_curso
                        WHERE asistencia_curso.ASISTENCIACURSO_Fecha = ? AND
                        asistencia_curso.CURSOID = ? AND
                        asistencia_curso.DOCENTEID = docente.DOCENTEID
                    )
                    THEN 1
                    ELSE 0
                END AS presente
            FROM tblCursoDocente AS curso_docente
            INNER JOIN tblDocente AS docente ON curso_docente.DOCENTEID = docente.DOCENTEID
            INNER JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE curso_docente.CURSOID = ?
            ORDER BY nombre ASC",
            [$date, $cursoId, $cursoId]
        )->getAll();
    }

    public function updateEncuestaEvaluacion($docenteId, $cursoId) {
        return $this->query(
            "UPDATE tblCursoDocente SET 
                CURSODOCENTE_EncuestaEvaluacion = 1 
                WHERE CURSOID = ? AND DOCENTEID = ?",
            [$cursoId, $docenteId]
        );
    }

    public function updateEncuestaEficacia($docenteId, $cursoId) {
        return $this->query(
            "UPDATE tblCursoDocente SET 
                CURSODOCENTE_EncuestaEficacia = 1 
                WHERE CURSOID = ? AND DOCENTEID = ?",
            [$cursoId, $docenteId]
        );
    }

    public function updateCalificacion($calificaciones, $cursoId, $alumnosIds) {
        $placeholders = implode(',', array_fill(0, count($alumnosIds), '(?, ?, ?)'));

        $params = [];
        foreach ($alumnosIds as $index => $alumnoId) {
            $params[] = $calificaciones[$index];
            $params[] = $cursoId;
            $params[] = $alumnoId;
        }

        return $this->query(
            "UPDATE tblCursoDocente SET 
                CURSODOCENTE_Calificacion = ? 
                WHERE CURSOID = ? AND DOCENTEID = ?",
            $params
        );
    }
    

    public function getParticipantesCurso($cursoId) {
        return $this->query(
            "SELECT COUNT(*) AS CantidadDocentes 
                FROM tblCursoDocente 
                WHERE CURSOID = ?
            ",
            [$cursoId]
        )->getOrFail();
    }
}
