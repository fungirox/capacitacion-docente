<?php

namespace Core\Repositories;

class DocenteRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT
                DOCENTEID as id,
                USER_Nombre + ' ' + USER_Apellido AS nombre
            FROM tblDocente AS docente
            LEFT JOIN tblUsuario AS usuario ON docente.USERID = usuario.USERID
            WHERE USER_Activo = 1
            ORDER BY USER_Nombre + ' ' + USER_Apellido ASC"
        )->getAll();    }
}
