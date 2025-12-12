<?php
class Empresa {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Obtener todas las empresas
    public function getEmpresas(){
        $this->db->query("SELECT * FROM empresas ORDER BY nombre ASC");
        return $this->db->resultSet();
    }

    // Obtener empresa por ID
    public function getEmpresaById($id){
        $this->db->query("SELECT * FROM empresas WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Register/Create Empresa
    public function addEmpresa($data){
        $this->db->query('INSERT INTO empresas (nombre, descripcion, direccion, telefono, website, logo, latitud, longitud) VALUES(:nombre, :descripcion, :direccion, :telefono, :website, :logo, :latitud, :longitud)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':latitud', $data['latitud']);
        $this->db->bind(':longitud', $data['longitud']);

        if($this->db->execute()){
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Update Empresa
    public function updateEmpresa($data){
        $this->db->query('UPDATE empresas SET nombre = :nombre, descripcion = :descripcion, direccion = :direccion, telefono = :telefono, website = :website, logo = :logo, latitud = :latitud, longitud = :longitud WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':latitud', $data['latitud']);
        $this->db->bind(':longitud', $data['longitud']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Delete Empresa
    public function deleteEmpresa($id){
        $this->db->query('DELETE FROM empresas WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
