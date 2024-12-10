<?php

namespace Core\Repositories;

class InstructorRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT 
                INSTRUCTORID as id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblInstructor AS instructor
            LEFT JOIN tblUsuario AS usuario ON instructor.USERID = usuario.USERID
            WHERE USER_Activo = 1
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC"
        )->getAll();
    }
}
