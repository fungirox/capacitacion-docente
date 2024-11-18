<?php

namespace Core\Repositories;

use Core\Repositories\RepositoryTemplate;

class CarreraRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query("SELECT * FROM tblCarrera")->getAll();
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

    public function delete($id) {
        return $this->query("DELETE FROM tblCarrera WHERE CARRERAID = ?", [$id]);
    }
}
