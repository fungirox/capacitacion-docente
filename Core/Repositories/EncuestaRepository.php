<?php

namespace Core\Repositories;

class EncuestaRepository extends RepositoryTemplate{
    public function getById($encuestaId){        
        return $this->query("SELECT 
            ENCUESTA_Nombre,
            ENCUESTA_Descripcion 
            FROM tblEncuesta
            WHERE ENCUESTAID = ?
        ",[$encuestaId])->getOrFail();
    }
}