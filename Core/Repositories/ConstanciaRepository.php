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

    public function getAllByUserId($userId)
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
                c.USERID = ?",
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
}
