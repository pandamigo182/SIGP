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

    public function getReportesPorPasantia($pasantiaId){
        $this->db->query("SELECT * FROM reportes WHERE pasantia_id = :pasantia_id ORDER BY semana DESC");
        $this->db->bind(':pasantia_id', $pasantiaId);
        return $this->db->resultSet();
    }

    public function getAllReportes(){
        $this->db->query("SELECT r.*, u.nombre as estudiante_nombre FROM reportes r JOIN usuarios u ON r.estudiante_id = u.id ORDER BY r.created_at DESC");
        return $this->db->resultSet();
    }

    public function addReporte($data){
        $this->db->query('INSERT INTO reportes (estudiante_id, pasantia_id, tutor_id, titulo, contenido, semana, archivo_adjunto, fecha_envio) VALUES(:estudiante_id, :pasantia_id, :tutor_id, :titulo, :contenido, :semana, :archivo, NOW())');
        $this->db->bind(':estudiante_id', $data['estudiante_id']);
        $this->db->bind(':pasantia_id', $data['pasantia_id']);
        $this->db->bind(':tutor_id', $data['tutor_id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':contenido', $data['contenido']);
        $this->db->bind(':semana', $data['semana']);
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

    public function updateRetroalimentacion($id, $feedback){
        $this->db->query('UPDATE reportes SET retroalimentacion = :feedback, estado = "revisado", fecha_revision = NOW() WHERE id = :id');
        $this->db->bind(':feedback', $feedback);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
