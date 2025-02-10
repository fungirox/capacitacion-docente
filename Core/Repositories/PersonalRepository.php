<?php

namespace Core\Repositories;

class PersonalRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT
                PERSONALID AS id,
                PERSONAL_Nombre AS nombre,
                PERSONAL_Puesto AS puesto
            FROM tblPersonal
            WHERE PERSONAL_Archivado = 0
            ORDER BY PERSONAL_Nombre ASC"
        )->getAll();
    }

    public function getById($personalId) {
        return $this->query(
            "SELECT * FROM 
                tblPersonal
            WHERE 
                PERSONALID = ?",
            [$personalId]
        )->getOrFail();
    }
}
