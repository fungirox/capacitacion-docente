<?php

namespace Core\Repositories;

class AreaRepository extends RepositoryTemplate {

    public function getAll($archivado = 0) {
        return $this->query(
            "SELECT
                AREAID as id,
                AREA_Nombre as nombre,
                AREA_Siglas as siglas
            FROM tblArea
            WHERE AREA_Archivado = $archivado
            ORDER BY Area_Nombre",
            [$archivado]
        )->getAll();
    }

    public function getById($id) {
        return $this->query("SELECT * FROM tblArea WHERE AREAID = ?", [$id])->getOrFail();
    }

    public function create($values) {
        return $this->query(
            "INSERT INTO tblArea (AREA_Nombre, AREA_Siglas) VALUES (?, ?)",
            [$values["nombre"], $values["siglas"]]
        );
    }

    public function update($values) {
        return $this->query(
            "UPDATE tblArea SET AREA_Nombre = ?, AREA_Siglas = ? WHERE AREAID = ?",
            [$values["nombre"], $values["siglas"], $values["id"]]
        );
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblArea SET AREA_Archivado = ? WHERE AREAID = ?",
            [$state, $id]
        );
    }

    public function delete($id) {
        return $this->query("DELETE FROM tblArea WHERE AREAID = ?", [$id]);
    }
}
