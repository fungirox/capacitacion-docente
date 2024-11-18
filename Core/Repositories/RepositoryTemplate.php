<?php

namespace Core\Repositories;

use Core\Database;

abstract class RepositoryTemplate {

    protected Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    protected function query($query, $params = []) {
        return $this->db->query($query, $params);
    }
}
