<?php
class Evaluacion {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addEvaluacion($data){
        // Primero verificamos si ya existe una evaluación para esta pasantía
        $this->db->query('SELECT id FROM evaluaciones WHERE pasantia_id = :pasantia_id');
        $this->db->bind(':pasantia_id', $data['pasantia_id']);
        $this->db->execute();
        
        if($this->db->rowCount() > 0){
            return false; // Ya evaluado
        }

        $this->db->query('INSERT INTO evaluaciones (empresa_id, estudiante_id, pasantia_id, calificacion_general, responsabilidad, conocimientos, trabajo_equipo, comentarios) VALUES(:empresa_id, :estudiante_id, :pasantia_id, :calificacion_general, :responsabilidad, :conocimientos, :trabajo_equipo, :comentarios)');
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':estudiante_id', $data['estudiante_id']);
        $this->db->bind(':pasantia_id', $data['pasantia_id']);
        $this->db->bind(':calificacion_general', $data['calificacion_general']);
        $this->db->bind(':responsabilidad', $data['responsabilidad']);
        $this->db->bind(':conocimientos', $data['conocimientos']);
        $this->db->bind(':trabajo_equipo', $data['trabajo_equipo']);
        $this->db->bind(':comentarios', $data['comentarios']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getEvaluacionByPasantia($pasantiaId){
        $this->db->query('SELECT * FROM evaluaciones WHERE pasantia_id = :pasantia_id');
        $this->db->bind(':pasantia_id', $pasantiaId);
        return $this->db->single();
    }
}
