<?php

namespace Core\Repositories;

class CarreraRepository extends RepositoryTemplate {

    public function getAll($archivado = 0) {
        return $this->query(
            "SELECT
                CARRERAID as id,
                CARRERA_Nombre as nombre,
                CARRERA_Siglas as siglas
            FROM tblCarrera
            WHERE CARRERA_Archivado = ?
            ORDER BY CARRERA_Nombre",
            [$archivado]
        )->getAll();
    }

    public function getById($id) {
        return $this->query("SELECT * FROM tblCarrera WHERE CARRERAID = ?", [$id])->getOrFail();
    }

    public function create($values) {
        return $this->query(
            "INSERT INTO tblCarrera (CARRERA_Nombre, CARRERA_Siglas) VALUES (?, ?)",
            [$values["nombre"], $values["siglas"]]
        );
    }

    public function update($values) {
        return $this->query(
            "UPDATE tblCarrera SET CARRERA_Nombre = ?, CARRERA_Siglas = ? WHERE CARRERAID = ?",
            [$values["nombre"], $values["siglas"], $values["id"]]
        );
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblCarrera SET CARRERA_Archivado = ? WHERE CARRERAID = ?",
            [$state, $id]
        );
    }

    public function delete($id) {
        return $this->query("DELETE FROM tblCarrera WHERE CARRERAID = ?", [$id]);
    }
}
