<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class ConstanciaRepository extends RepositoryTemplate
{
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getAllAsDocente($userId)
    {
        return $this->query(
            "SELECT 
            c.*,
            cu.CURSO_Nombre 
            FROM 
                tblConstancia c
            JOIN 
                tblCurso cu ON c.CURSOID = cu.CURSOID
            WHERE 
                c.USERID = ?
            AND 
                c.CONSTANCIA_Docente = 1",
            [$userId]
        )->getAll();
    }

    public function getAllAsInstructor($userId)
    {
        return $this->query(
            "SELECT 
            c.*,
            cu.CURSO_Nombre 
            FROM 
                tblConstancia c
            JOIN 
                tblCurso cu ON c.CURSOID = cu.CURSOID
            WHERE 
                c.USERID = ?
            AND 
                c.CONSTANCIA_Docente = 0",
            [$userId]
        )->getAll();
    }

    public function getById($constanciaId)
    {
        return $this->query(
            "SELECT 
            c.*
            FROM 
                tblConstancia c
            WHERE 
                c.CONSTANCIAID = ?",
            [$constanciaId]
        )->getOrFail();
    }

    public function getUltimoId(){
        return $this->query(
            "SELECT TOP 1 CONSTANCIAID FROM tblConstancia ORDER BY CONSTANCIAID DESC;"
        )->get();
    }

    public function setConstancia($cursoId, $usuarioId, $docente)
    {
        return $this->query(
            "INSERT INTO tblConstancia (CURSOID, USERID, CONSTANCIA_Docente) 
            VALUES (?, ?, ?)",
            [$cursoId, $usuarioId, $docente]
        );
    }

    public function setFolio($id, $folio)
    {
        return $this->query(
            "UPDATE tblConstancia SET CONSTANCIA_Folio = ? WHERE CONSTANCIAID = ?",
            [$folio, $id]
        );
    }
}
