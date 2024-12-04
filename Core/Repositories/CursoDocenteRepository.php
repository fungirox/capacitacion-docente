<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class CursoDocenteRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function updateEncuestaEvaluacion($docenteId,$cursoId){
        return $this->query(
            "UPDATE tblCursoDocente SET 
                CURSODOCENTE_EncuestaEvaluacion = 1 
                WHERE CURSOID = ? AND DOCENTEID = ?",
            [$cursoId,$docenteId]
        );
    }

    public function updateEncuestaEficacia($docenteId,$cursoId){
        return $this->query(
            "UPDATE tblCursoDocente SET 
                CURSODOCENTE_EncuestaEficacia = 1 
                WHERE CURSOID = ? AND DOCENTEID = ?",
            [$cursoId,$docenteId]
        );
    }
}