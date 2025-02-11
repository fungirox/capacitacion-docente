<?php

namespace Core\Repositories;

class AsistenciaCursoRepository extends RepositoryTemplate {

    public function getSessionCount($cursoId) {
        return $this->query(
            "SELECT COUNT(*) AS cantidad_sesiones
            FROM tblAsistenciaCurso
            WHERE CURSOID = ?
            GROUP BY CURSOID",
            [$cursoId]
        )->getAll();
    }

    public function createAsistencia($cursoId, $date, $alumnosIds) {
        $placeholders = implode(',', array_fill(0, count($alumnosIds), '(?, ?, ?)'));

        $params = [];
        foreach ($alumnosIds as $alumnoId) {
            $params[] = $cursoId;
            $params[] = $alumnoId;
            $params[] = $date;
        }

        return $this->query(
            "INSERT INTO tblAsistenciaCurso (CURSOID, DOCENTEID, ASISTENCIACURSO_Fecha)
            VALUES $placeholders",
            $params
        );
    }
}
