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
        $this->db->query('INSERT INTO empresas (nombre, descripcion, direccion, telefono, website, logo, latitud, longitud, nit, email_contacto, representante_legal, rubro, departamento_id, municipio_id, distrito_id, logo_path) VALUES(:nombre, :descripcion, :direccion, :telefono, :website, :logo, :latitud, :longitud, :nit, :email_contacto, :representante_legal, :rubro, :departamento_id, :municipio_id, :distrito_id, :logo_path)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':latitud', $data['latitud']);
        $this->db->bind(':longitud', $data['longitud']);
        $this->db->bind(':nit', $data['nit']);
        $this->db->bind(':email_contacto', $data['email_contacto']);
        $this->db->bind(':representante_legal', $data['representante_legal']);
        $this->db->bind(':rubro', $data['rubro']);
        $this->db->bind(':departamento_id', $data['departamento_id']);
        $this->db->bind(':municipio_id', $data['municipio_id']);
        $this->db->bind(':distrito_id', $data['distrito_id']);
        $this->db->bind(':logo_path', $data['logo_path']);

        if($this->db->execute()){
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Update Empresa
    public function updateEmpresa($data){
        $this->db->query('UPDATE empresas SET nombre = :nombre, descripcion = :descripcion, direccion = :direccion, telefono = :telefono, website = :website, logo = :logo, latitud = :latitud, longitud = :longitud, nit = :nit, email_contacto = :email_contacto, representante_legal = :representante_legal, rubro = :rubro, departamento_id = :departamento_id, municipio_id = :municipio_id, distrito_id = :distrito_id, logo_path = :logo_path WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':latitud', $data['latitud']);
        $this->db->bind(':longitud', $data['longitud']);
        $this->db->bind(':nit', $data['nit']);
        $this->db->bind(':email_contacto', $data['email_contacto']);
        $this->db->bind(':representante_legal', $data['representante_legal']);
        $this->db->bind(':rubro', $data['rubro']);
        $this->db->bind(':departamento_id', $data['departamento_id']);
        $this->db->bind(':municipio_id', $data['municipio_id']);
        $this->db->bind(':distrito_id', $data['distrito_id']);
        $this->db->bind(':logo_path', $data['logo_path']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getDepartamentos() {
        $this->db->query('SELECT * FROM departamentos ORDER BY departamento ASC');
        return $this->db->resultSet();
    }

    public function getMunicipios($id_departamento) {
        // Find codigo_departamento first or join
        $this->db->query('SELECT m.* FROM municipios m 
                          JOIN departamentos d ON m.codigo_departamento = d.codigo_departamento 
                          WHERE d.id_departamento = :id_departamento 
                          ORDER BY m.municipio ASC');
        $this->db->bind(':id_departamento', $id_departamento);
        return $this->db->resultSet();
    }

    public function getDistritos($id_municipio) {
        $this->db->query('SELECT d.* FROM distritos d 
                          JOIN municipios m ON d.codigo_municipio = m.codigo_municipio 
                          WHERE m.id_municipio = :id_municipio 
                          ORDER BY d.distrito ASC');
        $this->db->bind(':id_municipio', $id_municipio);
        return $this->db->resultSet();
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
