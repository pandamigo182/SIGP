<?php
class Encuesta {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Guardar nueva encuesta
    public function agregarEncuesta($data){
        $this->db->query('INSERT INTO encuestas_satisfaccion (usuario_id, tipo_usuario, nivel_satisfaccion, facilidad_uso, calidad_soporte, comentarios) VALUES (:usuario_id, :tipo_usuario, :nivel_satisfaccion, :facilidad_uso, :calidad_soporte, :comentarios)');
        
        $this->db->bind(':usuario_id', $data['usuario_id']);
        $this->db->bind(':tipo_usuario', $data['tipo_usuario']);
        $this->db->bind(':nivel_satisfaccion', $data['nivel_satisfaccion']);
        $this->db->bind(':facilidad_uso', $data['facilidad_uso']);
        $this->db->bind(':calidad_soporte', $data['calidad_soporte']);
        $this->db->bind(':comentarios', $data['comentarios']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Verificar si usuario ya contestó hoy (para evitar spam, opcional)
    // Por ahora simple insert.
}
