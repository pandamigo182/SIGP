<?php
// Load Config and Database
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

class Migration {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function run(){
        echo "Running Migrations...\n";

        // 1. Create 'empresas' table
        echo "Creating 'empresas' table...\n";
        $sql1 = "CREATE TABLE IF NOT EXISTS empresas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            descripcion TEXT,
            direccion VARCHAR(255),
            telefono VARCHAR(50),
            website VARCHAR(255),
            logo VARCHAR(255),
            latitud DECIMAL(10, 8),
            longitud DECIMAL(11, 8),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->query($sql1);
        if($this->db->execute()){
            echo "Table 'empresas' created successfully.\n";
        } else {
            echo "Error creating 'empresas' table.\n";
        }

        // 2. Alter 'usuarios' table - Add 'foto_perfil'
        echo "Adding 'foto_perfil' to 'usuarios'...\n";
        $this->db->query("SHOW COLUMNS FROM usuarios LIKE 'foto_perfil'");
        $result = $this->db->single();
        
        if(!$result){
             $sql2 = "ALTER TABLE usuarios ADD COLUMN foto_perfil VARCHAR(255) DEFAULT 'default.png'";
             $this->db->query($sql2);
             if($this->db->execute()) echo "Column 'foto_perfil' added.\n";
        } else {
            echo "Column 'foto_perfil' already exists.\n";
        }

        // 3. Alter 'usuarios' table - Add 'empresa_id'
        echo "Adding 'empresa_id' to 'usuarios'...\n";
        $this->db->query("SHOW COLUMNS FROM usuarios LIKE 'empresa_id'");
        $result = $this->db->single();

        if(!$result){
            $sql3 = "ALTER TABLE usuarios ADD COLUMN empresa_id INT DEFAULT NULL";
            $this->db->query($sql3);
            if($this->db->execute()) echo "Column 'empresa_id' added.\n";
            
            // Add FK
            // $sql4 = "ALTER TABLE usuarios ADD CONSTRAINT fk_usuario_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE SET NULL";
            // $this->db->query($sql4);
            // $this->db->execute();
        } else {
             echo "Column 'empresa_id' already exists.\n";
        }

        echo "Migrations Completed.\n";
    }
}

$migration = new Migration();
$migration->run();
