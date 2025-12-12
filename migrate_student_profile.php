<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

class MigrationStudentProfile {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function run(){
        echo "Starting Student Profile Migration...\n";
        
        // 1. Alter perfil_estudiantes
        echo "Modifying 'perfil_estudiantes'...\n";
        $columns = [
            "ADD COLUMN IF NOT EXISTS dui VARCHAR(20)",
            "ADD COLUMN IF NOT EXISTS edad INT",
            "ADD COLUMN IF NOT EXISTS genero VARCHAR(50)",
            "ADD COLUMN IF NOT EXISTS estado_civil VARCHAR(50)",
            "ADD COLUMN IF NOT EXISTS telefono VARCHAR(20)",
            "ADD COLUMN IF NOT EXISTS direccion TEXT",
            "ADD COLUMN IF NOT EXISTS departamento VARCHAR(100)",
            "ADD COLUMN IF NOT EXISTS municipio VARCHAR(100)",
            "ADD COLUMN IF NOT EXISTS institucion VARCHAR(255)",
            "ADD COLUMN IF NOT EXISTS nivel_academico VARCHAR(100)",
            "ADD COLUMN IF NOT EXISTS estado_ocupacional VARCHAR(50)", // Estudia, Trabaja, Ambos
            "ADD COLUMN IF NOT EXISTS cv_path VARCHAR(255)"
        ];
        
        foreach($columns as $col){
            try {
                $this->db->query("ALTER TABLE perfil_estudiantes $col");
                $this->db->execute();
            } catch(PDOException $e){
                // Ignore if exists or error (simplistic migration)
                echo "Column might already exist or error: " . $e->getMessage() . "\n";
            }
        }

        // 2. Create experiencia_laboral
        echo "Creating 'experiencia_laboral'...\n";
        $sqlExp = "CREATE TABLE IF NOT EXISTS experiencia_laboral (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            empresa VARCHAR(255),
            cargo VARCHAR(255),
            fecha_inicio DATE,
            fecha_fin DATE,
            descripcion TEXT,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
        )";
        $this->db->query($sqlExp);
        $this->db->execute();

        // 3. Create certificados
        echo "Creating 'certificados'...\n";
        $sqlCert = "CREATE TABLE IF NOT EXISTS certificados (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            nombre VARCHAR(255),
            archivo_path VARCHAR(255),
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
        )";
        $this->db->query($sqlCert);
        $this->db->execute();

        // 4. Create habilidades
        echo "Creating 'habilidades'...\n";
        $sqlHab = "CREATE TABLE IF NOT EXISTS habilidades (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            tipo VARCHAR(50) NOT NULL -- Tecnica, Psicosocial
        )";
        $this->db->query($sqlHab);
        $this->db->execute();

        // 5. Create usuario_habilidades (Pivot)
        echo "Creating 'usuario_habilidades'...\n";
        $sqlPiv = "CREATE TABLE IF NOT EXISTS usuario_habilidades (
            usuario_id INT NOT NULL,
            habilidad_id INT NOT NULL,
            PRIMARY KEY (usuario_id, habilidad_id),
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
            FOREIGN KEY (habilidad_id) REFERENCES habilidades(id) ON DELETE CASCADE
        )";
        $this->db->query($sqlPiv);
        $this->db->execute();

        // 6. Seed Habilidades
        echo "Seeding 'habilidades'...\n";
        $this->seedHabilidades();
        
        echo "Migration Completed.\n";
    }

    private function seedHabilidades(){
        $skills = [
            ['nombre' => 'Liderazgo', 'tipo' => 'Psicosocial'],
            ['nombre' => 'Trabajo en Equipo', 'tipo' => 'Psicosocial'],
            ['nombre' => 'Comunicación Efectiva', 'tipo' => 'Psicosocial'],
            ['nombre' => 'Resolución de Problemas', 'tipo' => 'Psicosocial'],
            ['nombre' => 'Adaptabilidad', 'tipo' => 'Psicosocial'],
            ['nombre' => 'PHP', 'tipo' => 'Tecnica'],
            ['nombre' => 'JavaScript', 'tipo' => 'Tecnica'],
            ['nombre' => 'HTML/CSS', 'tipo' => 'Tecnica'],
            ['nombre' => 'SQL', 'tipo' => 'Tecnica'],
            ['nombre' => 'Python', 'tipo' => 'Tecnica'],
            ['nombre' => 'Java', 'tipo' => 'Tecnica'],
            ['nombre' => 'Gestión de Proyectos', 'tipo' => 'Tecnica'],
            ['nombre' => 'Marketing Digital', 'tipo' => 'Tecnica'],
            ['nombre' => 'Diseño Gráfico', 'tipo' => 'Tecnica']
        ];

        // Check if empty
        $this->db->query("SELECT count(*) as count FROM habilidades");
        if($this->db->single()->count == 0){
            foreach($skills as $skill){
                $this->db->query("INSERT INTO habilidades (nombre, tipo) VALUES (:nombre, :tipo)");
                $this->db->bind(':nombre', $skill['nombre']);
                $this->db->bind(':tipo', $skill['tipo']);
                $this->db->execute();
            }
            echo "Seeded " . count($skills) . " skills.\n";
        } else {
            echo "Habilidades already seeded.\n";
        }
    }
}

$mig = new MigrationStudentProfile();
$mig->run();
