<?php
class Reporte {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getTotalStudents(){
        // Role 3 or 5? User said 5 in profile logic.
        $this->db->query("SELECT COUNT(*) as total FROM usuarios WHERE role_id = 5");
        $row = $this->db->single();
        return $row->total;
    }

    public function getTotalPlazas(){
        $this->db->query("SELECT COUNT(*) as total FROM plazas WHERE estado = 'abierta'");
        $row = $this->db->single();
        return $row->total;
    }

    public function getTotalEmpresas(){
        $this->db->query("SELECT COUNT(*) as total FROM empresas");
        $row = $this->db->single();
        return $row->total;
    }

    public function getGenderStats(){
        $this->db->query("SELECT genero, COUNT(*) as total FROM perfil_estudiantes WHERE genero != '' GROUP BY genero");
        return $this->db->resultSet();
    }

    public function getDepartmentStats(){
        // Group by user input text. 
        // Note: This relies on users typing correctly. 
        $this->db->query("SELECT departamento, COUNT(*) as total FROM perfil_estudiantes WHERE departamento != '' GROUP BY departamento");
        return $this->db->resultSet();
    }
    
    public function getEmpresasByRubro(){
        $this->db->query("SELECT rubro, COUNT(*) as total FROM empresas WHERE rubro != '' GROUP BY rubro");
         return $this->db->resultSet();
    }
}
