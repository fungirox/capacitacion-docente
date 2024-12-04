<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class RespuestaRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function setRespuesta($docenteId,$encuestaId,$cursoId){
        return $this->query(
            "INSERT INTO tblRespuesta (DOCENTEID,ENCUESTAID,CURSOID) 
                VALUES (?,?,?)",
            [$docenteId,$encuestaId,$cursoId]
        );
    }

    public function getUltimoId(){
        return $this->query(
            "SELECT TOP 1 RESPUESTAID FROM tblRespuesta ORDER BY RESPUESTAID DESC;"
        )->get();
    }
}