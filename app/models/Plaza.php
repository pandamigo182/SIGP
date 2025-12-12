<?php
class Plaza {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPlazas(){
        $this->db->query("SELECT *, 
                          plazas.id as plazaId, 
                          usuarios.id as empresaId,
                          plazas.created_at as fechaPublicacion
                          FROM plazas 
                          INNER JOIN usuarios 
                          ON plazas.empresa_id = usuarios.id 
                          WHERE plazas.estado = 'abierta'
                          ORDER BY plazas.created_at DESC");

        return $this->db->resultSet();
    }

    public function getPlazasByEmpresa($id){
        $this->db->query("SELECT * FROM plazas WHERE empresa_id = :id ORDER BY created_at DESC");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function addPlaza($data){
        $this->db->query('INSERT INTO plazas (empresa_id, titulo, descripcion, requisitos, fecha_limite) VALUES(:empresa_id, :titulo, :descripcion, :requisitos, :fecha_limite)');
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':requisitos', $data['requisitos']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPlazaById($id){
        $this->db->query('SELECT * FROM plazas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePlaza($data){
        $this->db->query('UPDATE plazas SET titulo = :titulo, descripcion = :descripcion, requisitos = :requisitos, fecha_limite = :fecha_limite, estado = :estado WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':requisitos', $data['requisitos']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);
        $this->db->bind(':estado', $data['estado']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
