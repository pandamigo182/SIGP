<?php
class Institucion {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getInstituciones(){
        $this->db->query("SELECT * FROM instituciones ORDER BY nombre ASC");
        return $this->db->resultSet();
    }

    public function getInstitucionById($id){
        $this->db->query("SELECT * FROM instituciones WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
