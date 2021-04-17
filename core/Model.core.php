<?php


class Model {
    private $table;
    private $db;
    public function __construct($table) {
        $this->table = $table;
        $this->db = DB::getInstance();
    }

    public function insert($fields) {
        return $this->db->insert($this->table, $fields);
    }

    public function select($fields, $selector = '*', $cond = '') {
        return $this->db->select($this->table, $fields, $selector, $cond);
    }

    public function update($set, $cond) {
        return $this->db->update($this->table, $set, $cond);
    }

    public function delete($cond) {
        return $this->db->delete($this->table, $cond);
    }

    public function softDelete($id) {
        return $this->db->softDelete($this->table, $id);
    }

    public function getById($identifier, $id) {
        return $this->db->select($this->table, [$identifier => $id]);
    }
}