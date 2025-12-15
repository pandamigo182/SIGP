<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

class MigrationV2 {
    private $db;

    public function __construct(){
        $this->db = new Database;
        echo "Iniciando migración V2...\n";
        $this->run();
    }

    private function run(){
        $this->createLocationTables();
        $this->updateEmpresasTable();
        $this->verifyPasantiasTable();
        echo "Migración V2 completada.\n";
    }

    private function createLocationTables(){
        echo "Creando tablas de ubicación...\n";
        
        // Departamentos
        $sql = "CREATE TABLE IF NOT EXISTS departamentos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Municipios
        $sql = "CREATE TABLE IF NOT EXISTS municipios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            departamento_id INT NOT NULL,
            FOREIGN KEY (departamento_id) REFERENCES departamentos(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Distritos
        $sql = "CREATE TABLE IF NOT EXISTS distritos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            municipio_id INT NOT NULL,
            FOREIGN KEY (municipio_id) REFERENCES municipios(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Seed Departamentos (Example data for El Salvador)
        $this->seedLocations();
    }

    private function seedLocations(){
        // Check if data exists
        $this->db->query("SELECT COUNT(*) as count FROM departamentos");
        $res = $this->db->single();
        if($res->count > 0) return;

        echo "Poblando Departamentos...\n";
        $deptos = [
            'Ahuachapán', 'Santa Ana', 'Sonsonate', 'Chalatenango', 
            'La Libertad', 'San Salvador', 'Cuscatlán', 'La Paz', 
            'Cabañas', 'San Vicente', 'Usulután', 'San Miguel', 
            'Morazán', 'La Unión'
        ];

        foreach($deptos as $nombre){
            $this->db->query("INSERT INTO departamentos (nombre) VALUES (:nombre)");
            $this->db->bind(':nombre', $nombre);
            $this->db->execute();
        }
        
        // Note: Full seeding of Municipios/Distritos is large, adding a few examples or placeholders
        // In a real scenario, we'd import a full SQL dump for this.
        // For now, I will ensure the tables exist.
    }

    private function updateEmpresasTable(){
        echo "Actualizando tabla empresas...\n";
        
        // Add columns if they don't exist
        $cols = [
            'nit' => "VARCHAR(20) DEFAULT NULL",
            'email_contacto' => "VARCHAR(100) DEFAULT NULL",
            'representante_legal' => "VARCHAR(150) DEFAULT NULL",
            'rubro' => "VARCHAR(100) DEFAULT NULL",
            'departamento_id' => "INT DEFAULT NULL",
            'municipio_id' => "INT DEFAULT NULL",
            'distrito_id' => "INT DEFAULT NULL",
            'logo_path' => "VARCHAR(255) DEFAULT NULL" // Renaming/Standardizing logo field
        ];

        foreach($cols as $colName => $def){
            try {
                $this->db->query("ALTER TABLE empresas ADD COLUMN $colName $def");
                $this->db->execute();
                echo "Columna $colName agregada.\n";
            } catch (PDOException $e) {
                // Column likely exists
            }
        }
        
        // Ensure lat/long exist (added in V1 but just in case)
        try {
            $this->db->query("ALTER TABLE empresas ADD COLUMN latitud VARCHAR(50) DEFAULT NULL");
            $this->db->execute();
        } catch(Exception $e){}
        try {
            $this->db->query("ALTER TABLE empresas ADD COLUMN longitud VARCHAR(50) DEFAULT NULL");
            $this->db->execute();
        } catch(Exception $e){}
    }

    private function verifyPasantiasTable(){
        echo "Verificando tabla pasantias...\n";
        $sql = "CREATE TABLE IF NOT EXISTS pasantias (
            id INT AUTO_INCREMENT PRIMARY KEY,
            estudiante_id INT NOT NULL,
            empresa_id INT NOT NULL,
            fecha_inicio DATE,
            fecha_fin DATE,
            estado ENUM('pendiente', 'activa', 'finalizada', 'cancelada') DEFAULT 'pendiente',
            tutor_id INT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE,
            FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();
    }
}

new MigrationV2();
