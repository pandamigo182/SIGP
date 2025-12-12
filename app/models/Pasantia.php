<?php
class Pasantia {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Get all internships
    public function getPasantias(){
        $this->db->query("SELECT p.*, 
                                 u.nombre as nombre_estudiante, 
                                 e.nombre as nombre_empresa,
                                 i.nombre as nombre_institucion
                          FROM pasantias p
                          LEFT JOIN usuarios u ON p.estudiante_id = u.id
                          LEFT JOIN empresas e ON p.empresa_id = e.id
                          LEFT JOIN instituciones i ON p.institucion_id = i.id
                          ORDER BY p.created_at DESC");
        return $this->db->resultSet();
    }

    // Add Internship
    public function addPasantia($data){
        $this->db->query('INSERT INTO pasantias (estudiante_id, empresa_id, tutor_id, institucion_id, proyecto_asociado, fecha_inicio, fecha_fin, estado) VALUES(:estudiante_id, :empresa_id, :tutor_id, :institucion_id, :proyecto_asociado, :fecha_inicio, :fecha_fin, :estado)');
        $this->db->bind(':estudiante_id', $data['estudiante_id']);
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':tutor_id', $data['tutor_id']);
        $this->db->bind(':institucion_id', $data['institucion_id']);
        $this->db->bind(':proyecto_asociado', $data['proyecto_asociado']);
        $this->db->bind(':fecha_inicio', $data['fecha_inicio']);
        $this->db->bind(':fecha_fin', $data['fecha_fin']);
        $this->db->bind(':estado', $data['estado']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Get Pasantia Linked Data (Helpers)
    // Could add methods to get students, companies, tutors here or in respective models.
}
