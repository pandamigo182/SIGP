<?php
class SystemSetting {
    private $db;

    public function __construct(){
        $this->db = new Database;
        // Ensure table exists (Quick fix for this environment to avoid manual SQL)
        $this->ensureTableExists();
    }

    private function ensureTableExists(){
        $sql = "CREATE TABLE IF NOT EXISTS system_settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre_empresa VARCHAR(255),
            direccion TEXT,
            telefono VARCHAR(50),
            whatsapp VARCHAR(50),
            email VARCHAR(100),
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $this->db->query($sql);
        $this->db->execute();
        
        // Seed if empty
        $this->db->query("SELECT id FROM system_settings WHERE id = 1");
        if(!$this->db->single()){
            $this->db->query("INSERT INTO system_settings (nombre_empresa, direccion, telefono, whatsapp, email) VALUES (:nombre, :dir, :tel, :wa, :email)");
            $this->db->bind(':nombre', 'SIGP - Sistema Integral');
            $this->db->bind(':dir', 'San Salvador, El Salvador');
            $this->db->bind(':tel', '+503 2222-0000');
            $this->db->bind(':wa', '50370000000');
            $this->db->bind(':email', 'contacto@sigp.sv');
            $this->db->execute();
        }
    }

    public function getSettings(){
        $this->db->query("SELECT * FROM system_settings WHERE id = 1");
        return $this->db->single();
    }

    public function updateSettings($data){
        $this->db->query("UPDATE system_settings SET nombre_empresa = :nombre, direccion = :direccion, telefono = :telefono, whatsapp = :whatsapp, email = :email WHERE id = 1");
        $this->db->bind(':nombre', $data['nombre_empresa']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':email', $data['email']);
        return $this->db->execute();
    }
}
