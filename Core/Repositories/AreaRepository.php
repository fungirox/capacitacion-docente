<?php

namespace Core\Repositories;

use Core\Repositories\RepositoryTemplate;

class AreaRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query("SELECT * FROM tblArea")->getAll();
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

    public function delete($id) {
        return $this->query("DELETE FROM tblArea WHERE AREAID = ?", [$id]);
    }
}
