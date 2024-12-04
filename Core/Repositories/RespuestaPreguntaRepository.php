<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class RespuestaPreguntaRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function setRespuestas($texto,$respuestaId,$preguntaId){
        return $this->query(
            "INSERT INTO tblRespuestaPregunta (RESPUESTAPREGUNTA_Texto,
                RESPUESTAID, PREGUNTAID) 
            VALUES (?, ?, ?)",
            [$texto,$respuestaId,$preguntaId]
        );
    }
}