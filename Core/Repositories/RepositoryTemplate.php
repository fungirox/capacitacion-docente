<?php

namespace Core\Repositories;

use Core\Database;

abstract class RepositoryTemplate {

    protected Database $db;
    protected $validOrders = ["ASC", "DESC"];

    public function __construct(Database $db) {
        $this->db = $db;
    }

    protected function query($query, $params = []) {
        return $this->db->query($query, $params);
    }

    public function getDatabase() {
        return $this->db;
    }

    public function getOffset ($page, $limit) {
        return ($page - 1) * $limit;
    }
}
