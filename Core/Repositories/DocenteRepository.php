<?php

namespace Core\Repositories;

use Core\Roles\Roles;
use Core\Session;

class DocenteRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getDocenteId($userId){
        return $this->query(
            "SELECT d.DOCENTEID
                FROM tblUsuario u
                JOIN tblDocente d ON u.USERID = d.USERID
                WHERE u.USERID = ?",
            [$userId]
        )->get();
    }
}