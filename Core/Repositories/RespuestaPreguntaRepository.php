<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class RespuestaPreguntaRepository extends RepositoryTemplate
{
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function setRespuestas($texto, $respuestaId, $preguntaId)
    {
        return $this->query(
            "INSERT INTO tblRespuestaPregunta (RESPUESTAPREGUNTA_Texto,
                RESPUESTAID, PREGUNTAID) 
            VALUES (?, ?, ?)",
            [$texto, $respuestaId, $preguntaId]
        );
    }

    public function getRespuestas($cursoId, $encuestaId)
    {
        return $this->query("SELECT CAST(p.PREGUNTA_Texto AS VARCHAR(MAX)) AS PREGUNTA_Texto, 
                AVG(CAST(rp.RESPUESTAPREGUNTA_Texto AS FLOAT)) AS Promedio
                FROM tblRespuestaPregunta rp
                JOIN tblRespuesta r ON rp.RESPUESTAID = r.RESPUESTAID
                JOIN tblPregunta p ON rp.PREGUNTAID = p.PREGUNTAID
                WHERE r.ENCUESTAID = ?
                AND r.CURSOID = ?
                AND ISNUMERIC(rp.RESPUESTAPREGUNTA_Texto) = 1
                GROUP BY p.PREGUNTAID, CAST(p.PREGUNTA_Texto AS VARCHAR(MAX))
                ORDER BY p.PREGUNTAID 
        ", [$encuestaId, $cursoId])->getAll();
    }
}
