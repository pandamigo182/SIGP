<?php
// Load Config and Database
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

class MigrationCarreras {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function run(){
        echo "Checking 'carreras' table...\n";
        
        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS carreras (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL
        )";
        $this->db->query($sql);
        $this->db->execute();

        // Seed if empty
        $this->db->query("SELECT count(*) as count FROM carreras");
        $row = $this->db->single();
        
        if($row->count == 0){
            echo "Seeding 'carreras'...\n";
            $carreras = [
                'Ingeniería en Sistemas',
                'Licenciatura en Computación',
                'Ingeniería Industrial',
                'Administración de Empresas',
                'Marketing Digital'
            ];
            
            foreach($carreras as $carrera){
                $this->db->query("INSERT INTO carreras (nombre) VALUES (:nombre)");
                $this->db->bind(':nombre', $carrera);
                $this->db->execute();
            }
            echo "Seeded " . count($carreras) . " carreras.\n";
        } else {
            echo "Carreras table already validation populated.\n";
        }
    }
}

$mig = new MigrationCarreras();
$mig->run();
