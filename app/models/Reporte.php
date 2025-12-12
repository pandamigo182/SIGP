<?php
class Reporte {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getReportesByStudent($id){
        $this->db->query('SELECT * FROM reportes WHERE estudiante_id = :id ORDER BY created_at DESC');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function getAllReportes(){
        $this->db->query("SELECT *, 
                          reportes.id as reporteId,
                          usuarios.nombre as nombreEstudiante,
                          reportes.created_at as fechaReporte
                          FROM reportes 
                          INNER JOIN usuarios 
                          ON reportes.estudiante_id = usuarios.id 
                          ORDER BY reportes.created_at DESC");
        return $this->db->resultSet();
    }

    public function addReporte($data){
        $this->db->query('INSERT INTO reportes (estudiante_id, titulo, descripcion, horas_registradas, archivo_adjunto) VALUES(:estudiante_id, :titulo, :descripcion, :horas, :archivo)');
        $this->db->bind(':estudiante_id', $data['estudiante_id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':horas', $data['horas']);
        $this->db->bind(':archivo', $data['archivo']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getReporteById($id){
        $this->db->query('SELECT * FROM reportes WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
