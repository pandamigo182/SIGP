<?php
class Postulacion {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function agregarPostulacion($data){
        $this->db->query('INSERT INTO postulaciones (plaza_id, estudiante_id, estado) VALUES(:plaza_id, :estudiante_id, "pendiente")');
        $this->db->bind(':plaza_id', $data['plaza_id']);
        $this->db->bind(':estudiante_id', $data['estudiante_id']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function verificarPostulacion($estudiante_id, $plaza_id){
        $this->db->query('SELECT * FROM postulaciones WHERE estudiante_id = :estudiante_id AND plaza_id = :plaza_id');
        $this->db->bind(':estudiante_id', $estudiante_id);
        $this->db->bind(':plaza_id', $plaza_id);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function getPostulantesPorPlaza($plaza_id){
        $this->db->query("SELECT *, 
                          postulaciones.id as postulacionId,
                          usuarios.nombre as nombreEstudiante,
                          usuarios.email as emailEstudiante,
                          postulaciones.fecha_postulacion as fechaPostulacion,
                          postulaciones.estado as estadoPostulacion
                          FROM postulaciones 
                          INNER JOIN usuarios 
                          ON postulaciones.estudiante_id = usuarios.id 
                          WHERE postulaciones.plaza_id = :plaza_id
                          ORDER BY postulaciones.fecha_postulacion DESC");
        
        $this->db->bind(':plaza_id', $plaza_id);
        return $this->db->resultSet();
    }

    // Obtener mis postulaciones (Estudiante)
    public function getPostulacionesPorEstudiante($estudiante_id){
        $this->db->query("SELECT p.*, pl.titulo as plaza_titulo, pl.empresa_id, u.nombre as empresa_nombre 
                          FROM postulaciones p
                          INNER JOIN plazas pl ON p.plaza_id = pl.id
                          INNER JOIN usuarios u ON pl.empresa_id = u.id
                          WHERE p.estudiante_id = :estudiante_id
                          ORDER BY p.fecha_postulacion DESC");
        $this->db->bind(':estudiante_id', $estudiante_id);
        return $this->db->resultSet();
    }

    // Actualizar estado (Aceptado/Rechazado)
    public function actualizarEstado($id, $estado){
        $this->db->query("UPDATE postulaciones SET estado = :estado WHERE id = :id");
        $this->db->bind(':estado', $estado);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }



    public function getPostulacionesByEstudiante($id){
        $this->db->query("SELECT *, 
                          postulaciones.id as postulacionId,
                          plazas.titulo as tituloPlaza,
                          usuarios.nombre as nombreEmpresa,
                          postulaciones.fecha_postulacion as fechaPostulacion,
                          postulaciones.estado as estadoPostulacion
                          FROM postulaciones 
                          INNER JOIN plazas ON postulaciones.plaza_id = plazas.id
                          INNER JOIN usuarios ON plazas.empresa_id = usuarios.id
                          WHERE postulaciones.estudiante_id = :id
                          ORDER BY postulaciones.fecha_postulacion DESC");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    public function getPostulacionById($id){
        $this->db->query("SELECT * FROM postulaciones WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
