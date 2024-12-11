<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class PreguntaRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getPreguntas($encuestaId){
        return $this->query(
            "SELECT *
            FROM tblPregunta
            WHERE ENCUESTAID = ?",
            [$encuestaId]
        )->getAll();
    }

    
}