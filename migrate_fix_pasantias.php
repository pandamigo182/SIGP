<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

class MigrationFixPasantias {
    private $db;

    public function __construct(){
        $this->db = new Database;
        echo "Iniciando Corrección de Pasantias...\n";
        $this->run();
    }

    private function run(){
        $this->createInstitucionesTable();
        $this->updatePasantiasTable();
        echo "Corrección Completada.\n";
    }

    private function createInstitucionesTable(){
        echo "Creando tabla instituciones...\n";
        $sql = "CREATE TABLE IF NOT EXISTS instituciones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(150) NOT NULL,
            direccion VARCHAR(255),
            telefono VARCHAR(20),
            email VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Seed default institution
        $this->db->query("SELECT count(*) as count FROM instituciones");
        if($this->db->single()->count == 0){
            $this->db->query("INSERT INTO instituciones (nombre) VALUES ('Universidad Don Bosco')");
            $this->db->execute();
        }
    }

    private function updatePasantiasTable(){
        echo "Actualizando tabla pasantias...\n";
        
        // Add institucion_id
        try {
            $this->db->query("ALTER TABLE pasantias ADD COLUMN institucion_id INT NULL");
            $this->db->execute();
            echo "Columna institucion_id agregada.\n";
        } catch(Exception $e){}

        // Add proyecto_asociado
        try {
            $this->db->query("ALTER TABLE pasantias ADD COLUMN proyecto_asociado VARCHAR(255) NULL");
            $this->db->execute();
            echo "Columna proyecto_asociado agregada.\n";
        } catch(Exception $e){}

        // Add Foreign Key
        try {
            $this->db->query("ALTER TABLE pasantias ADD CONSTRAINT fk_pasantias_institucion FOREIGN KEY (institucion_id) REFERENCES instituciones(id) ON DELETE SET NULL");
            $this->db->execute();
            echo "FK institucion agregada.\n";
        } catch(Exception $e){}
    }
}

new MigrationFixPasantias();
