<?php
class Carrera {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getCarreras(){
        $this->db->query("SELECT * FROM carreras ORDER BY nombre ASC");
        return $this->db->resultSet();
    }
}
