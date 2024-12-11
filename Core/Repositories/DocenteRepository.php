<?php

namespace Core\Repositories;

use Core\Roles\Roles;

class DocenteRepository extends RepositoryTemplate {
    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getAll() {
        return $this->query(
            "SELECT
                DOCENTEID as id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblDocente AS docente
            LEFT JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE USER_Activo = 1
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC"
        )->getAll();
    }

    public function getDocenteId($userId) {
        return $this->query(
            "SELECT d.DOCENTEID
                FROM tblUsuario u
                JOIN tblDocente d ON u.USERID = d.USERID
                WHERE u.USERID = ?",
            [$userId]
        )->get();
    }
}
