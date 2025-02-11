<?php

namespace Core\Repositories;

class CursoDocenteRepository extends RepositoryTemplate {

    public function getDocentesFromCurso($cursoId) {
        return $this->query(
            "SELECT
                docente.DOCENTEID AS id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblCursoDocente AS curso_docente
            INNER JOIN tblDocente AS docente ON curso_docente.DOCENTEID = docente.DOCENTEID
            INNER JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE curso_docente.CURSOID = ? 
            ORDER BY nombre ASC",
            [$cursoId]
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
