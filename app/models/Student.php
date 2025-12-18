<?php
class Student {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // --- Profile ---
    public function getProfile($userId){
        $this->db->query("SELECT * FROM perfil_estudiantes WHERE usuario_id = :id");
        $this->db->bind(':id', $userId);
        return $this->db->single();
    }

    public function updateProfile($userId, $data){
        // Check if exists
        if(!$this->getProfile($userId)){
            $this->db->query("INSERT INTO perfil_estudiantes (usuario_id) VALUES (:id)");
            $this->db->bind(':id', $userId);
            $this->db->execute();
        }

        $sql = "UPDATE perfil_estudiantes SET 
                matricula = :matricula, 
                carrera_id = :carrera_id,
                dui = :dui,
                edad = :edad,
                genero = :genero,
                estado_civil = :estado_civil,
                telefono = :telefono,
                direccion = :direccion,
                departamento_id = :departamento_id,
                municipio_id = :municipio_id,
                distrito_id = :distrito_id,
                institucion = :institucion,
                nivel_academico = :nivel_academico,
                estado_ocupacional = :estado_ocupacional
                WHERE usuario_id = :id";
        
        $this->db->query($sql);
        $this->db->bind(':id', $userId);
        $this->db->bind(':matricula', $data['matricula']);
        $this->db->bind(':carrera_id', $data['carrera_id']);
        $this->db->bind(':dui', $data['dui']);
        $this->db->bind(':edad', $data['edad']);
        $this->db->bind(':genero', $data['genero']);
        $this->db->bind(':estado_civil', $data['estado_civil']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':departamento_id', $data['departamento_id']);
        $this->db->bind(':municipio_id', $data['municipio_id']);
        $this->db->bind(':distrito_id', $data['distrito_id']);
        $this->db->bind(':institucion', $data['institucion']);
        $this->db->bind(':nivel_academico', $data['nivel_academico']);
        $this->db->bind(':estado_ocupacional', $data['estado_ocupacional']);
        
        return $this->db->execute();
    }
    
    public function updateCV($userId, $path){
        $this->db->query("UPDATE perfil_estudiantes SET cv_path = :path WHERE usuario_id = :id");
        $this->db->bind(':path', $path);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    // --- Experience ---
    public function getExperience($userId){
        $this->db->query("SELECT * FROM experiencia_laboral WHERE usuario_id = :id ORDER BY fecha_inicio DESC");
        $this->db->bind(':id', $userId);
        return $this->db->resultSet();
    }

    public function addExperience($data){
        $this->db->query("INSERT INTO experiencia_laboral (usuario_id, empresa, cargo, fecha_inicio, fecha_fin, descripcion) VALUES (:uid, :emp, :car, :ini, :fin, :desc)");
        $this->db->bind(':uid', $data['usuario_id']);
        $this->db->bind(':emp', $data['empresa']);
        $this->db->bind(':car', $data['cargo']);
        $this->db->bind(':ini', $data['fecha_inicio']);
        $this->db->bind(':fin', $data['fecha_fin']);
        $this->db->bind(':desc', $data['descripcion']);
        return $this->db->execute();
    }
    
    public function deleteExperience($id){
        $this->db->query("DELETE FROM experiencia_laboral WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // --- Certificates ---
    public function getCertificates($userId){
        $this->db->query("SELECT * FROM certificados WHERE usuario_id = :id");
        $this->db->bind(':id', $userId);
        return $this->db->resultSet();
    }

    public function addCertificate($userId, $name, $path){
        $this->db->query("INSERT INTO certificados (usuario_id, nombre, archivo_path) VALUES (:uid, :nom, :path)");
        $this->db->bind(':uid', $userId);
        $this->db->bind(':nom', $name);
        $this->db->bind(':path', $path);
        return $this->db->execute();
    }
    
    public function deleteCertificate($id){
        // Ideally should delete file too, but simplistic here
        $this->db->query("DELETE FROM certificados WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // --- Skills ---
    public function getAllSkills(){
        $this->db->query("SELECT * FROM habilidades ORDER BY nombre ASC");
        return $this->db->resultSet();
    }

    public function getStudentSkills($userId){
        $this->db->query("SELECT h.id, h.nombre, h.tipo FROM habilidades h JOIN usuario_habilidades uh ON h.id = uh.habilidad_id WHERE uh.usuario_id = :uid");
        $this->db->bind(':uid', $userId);
        return $this->db->resultSet();
    }

    public function syncSkills($userId, $skillIds){
        // Delete current skills
        $this->db->query("DELETE FROM usuario_habilidades WHERE usuario_id = :uid");
        $this->db->bind(':uid', $userId);
        $this->db->execute();

        // Add new skills
        if(!empty($skillIds)){
            foreach($skillIds as $sid){
                $this->db->query("INSERT INTO usuario_habilidades (usuario_id, habilidad_id) VALUES (:uid, :sid)");
                $this->db->bind(':uid', $userId);
                $this->db->bind(':sid', $sid);
                $this->db->execute();
            }
        }
        return true;
    }

    public function getStudentsByInstitucion($institucionId){
        $this->db->query("SELECT u.id, u.nombre, u.email, p.matricula, c.nombre as carrera
                          FROM usuarios u 
                          LEFT JOIN perfil_estudiantes p ON u.id = p.usuario_id 
                          LEFT JOIN carreras c ON p.carrera_id = c.id
                          WHERE u.role_id = 5 AND u.institucion_id = :id");
        $this->db->bind(':id', $institucionId);
        return $this->db->resultSet();
    }
}
