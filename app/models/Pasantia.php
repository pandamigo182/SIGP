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
    public function getPasantiasPorEstado($estado){
        $this->db->query("SELECT p.*, 
                                 u.nombre as nombre_estudiante, 
                                 e.nombre as nombre_empresa,
                                 i.nombre as nombre_institucion,
                                 u2.nombre as nombre_tutor
                          FROM pasantias p
                          LEFT JOIN usuarios u ON p.estudiante_id = u.id
                          LEFT JOIN empresas e ON p.empresa_id = e.id
                          LEFT JOIN instituciones i ON p.institucion_id = i.id
                          LEFT JOIN usuarios u2 ON p.tutor_id = u2.id
                          WHERE p.estado = :estado
                          ORDER BY p.created_at DESC");
        $this->db->bind(':estado', $estado);
        return $this->db->resultSet();
    }

    public function asignarTutor($pasantiaId, $tutorId){
        $this->db->query('UPDATE pasantias SET tutor_id = :tutor_id WHERE id = :id');
        $this->db->bind(':tutor_id', $tutorId);
        $this->db->bind(':id', $pasantiaId);
        return $this->db->execute();
    }

    // Get Active Internship by User
    public function getPasantiaActivaPorusuario($userId){
        $this->db->query("SELECT p.*, e.nombre as nombre_empresa 
                          FROM pasantias p
                          LEFT JOIN empresas e ON p.empresa_id = e.id 
                          WHERE p.estudiante_id = :id AND (p.estado = 'activa' OR p.estado = 'aceptado')");
        $this->db->bind(':id', $userId);
        return $this->db->single();
    }

    public function getPasantiaById($id){
        $this->db->query("SELECT p.*, u.nombre as nombre_estudiante, e.nombre as nombre_empresa 
                          FROM pasantias p 
                          LEFT JOIN usuarios u ON p.estudiante_id = u.id
                          LEFT JOIN empresas e ON p.empresa_id = e.id
                          WHERE p.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getPasantiasByTutor($tutorId){
        $this->db->query("SELECT p.*, u.nombre as nombre_estudiante, e.nombre as nombre_empresa
                          FROM pasantias p
                          LEFT JOIN usuarios u ON p.estudiante_id = u.id
                          LEFT JOIN empresas e ON p.empresa_id = e.id
                          WHERE p.tutor_id = :tutor_id AND p.estado = 'activa'");
        $this->db->bind(':tutor_id', $tutorId);
        return $this->db->resultSet();
    }

    public function getPasantiasByEmpresa($empresaId){
        // Assuming empresaId (User ID of Role 4) is stored in empresa_id column of Pasantias.
        $this->db->query("SELECT p.*, u.nombre as nombre_estudiante
                          FROM pasantias p
                          LEFT JOIN usuarios u ON p.estudiante_id = u.id
                          WHERE p.empresa_id = :empresa_id AND p.estado != 'cancelada'
                          ORDER BY p.created_at DESC");
        $this->db->bind(':empresa_id', $empresaId);
        return $this->db->resultSet();
    }

    public function addEvaluacionEmpresa($data){
        $this->db->query('INSERT INTO evaluaciones_empresa (pasantia_id, empresa_id, rating, comentarios, competencias_evaluadas) VALUES(:pasantia_id, :empresa_id, :rating, :comentarios, :criterios)');
        $this->db->bind(':pasantia_id', $data['pasantia_id']);
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comentarios', $data['comentarios']);
        $this->db->bind(':criterios', $data['criterios']);

        return $this->db->execute();
    }

    public function finalizarPasantia($id){
        $this->db->query("UPDATE pasantias SET estado = 'finalizada', fecha_fin = NOW() WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function checkFeedbackEstudiante($pasantiaId){
        $this->db->query("SELECT * FROM evaluaciones_estudiante WHERE pasantia_id = :id");
        $this->db->bind(':id', $pasantiaId);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function addEvaluacionEstudiante($data){
        $this->db->query('INSERT INTO evaluaciones_estudiante (pasantia_id, estudiante_id, empresa_id, rating, comentarios) VALUES(:pasantia_id, :estudiante_id, :empresa_id, :rating, :comentarios)');
        $this->db->bind(':pasantia_id', $data['pasantia_id']);
        $this->db->bind(':estudiante_id', $data['estudiante_id']);
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comentarios', $data['comentarios']);
        return $this->db->execute();
    }

    public function getPasantiasPorEstudiante($estudianteId){
        $this->db->query("SELECT p.*, e.nombre as nombre_empresa 
                          FROM pasantias p
                          LEFT JOIN empresas e ON p.empresa_id = e.id 
                          WHERE p.estudiante_id = :id
                          ORDER BY p.created_at DESC");
        $this->db->bind(':id', $estudianteId);
        return $this->db->resultSet();
    }
}
