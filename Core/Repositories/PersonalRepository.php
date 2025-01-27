<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class PersonalRepository extends RepositoryTemplate
{
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getById($personalId)
    {
        return $this->query(
            "SELECT * FROM 
                tblPersonal
            WHERE 
                PERSONALID = ?",
            [$personalId]
        )->getOrFail();
    }
}
