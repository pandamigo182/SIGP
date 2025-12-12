// Ajustar ruta si se ejecuta desde raíz
if(file_exists(__DIR__ . '/app/config/config.php')){
    require_once __DIR__ . '/app/config/config.php';
    require_once __DIR__ . '/app/core/Database.php';
} else {
    // Si se ejecuta desde public o subcarpeta (fallback) - though __DIR__ is best
    require_once __DIR__ . '/../app/config/config.php';
    require_once __DIR__ . '/../app/core/Database.php';
}

class MigrationEntities {
    private $db;

    public function __construct(){
        $this->db = new Database;
        echo "Iniciando migración de Entidades y Pasantías...\n";
    }

    public function run(){
        // 1. Create Instituciones Table
        $sqlInstituciones = "CREATE TABLE IF NOT EXISTS instituciones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            direccion VARCHAR(255),
            telefono VARCHAR(20),
            contacto_nombre VARCHAR(100),
            logo VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->query($sqlInstituciones);
        $this->db->execute();
        echo "- Tabla 'instituciones' creada/verificada.\n";

        // 2. Add 'institucion_id' to 'perfil_estudiantes' if not exists
        if(!$this->columnExists('perfil_estudiantes', 'institucion_id')){
            $this->db->query("ALTER TABLE perfil_estudiantes ADD COLUMN institucion_id INT NULL");
            $this->db->execute();
            echo "- Columna 'institucion_id' agregada a 'perfil_estudiantes'.\n";
        }

        // 3. Add 'institucion_id' to 'usuarios' if not exists (for Reps)
        if(!$this->columnExists('usuarios', 'institucion_id')){
            $this->db->query("ALTER TABLE usuarios ADD COLUMN institucion_id INT NULL");
            $this->db->execute();
            echo "- Columna 'institucion_id' agregada a 'usuarios'.\n";
        }

        // 4. Create Pasantias Table
        $sqlPasantias = "CREATE TABLE IF NOT EXISTS pasantias (
            id INT AUTO_INCREMENT PRIMARY KEY,
            estudiante_id INT NOT NULL,
            empresa_id INT NOT NULL,
            tutor_id INT NULL, 
            institucion_id INT NULL,
            proyecto_asociado VARCHAR(255),
            fecha_inicio DATE,
            fecha_fin DATE,
            estado ENUM('Pendiente', 'Activa', 'Finalizada', 'Cancelada') DEFAULT 'Pendiente',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
        )";
        // Note: Linking estudiante_id to usuarios(id) or perfil_estudiantes(usuario_id)? Usually users.id
        $this->db->query($sqlPasantias);
        $this->db->execute();
        echo "- Tabla 'pasantias' creada/verificada.\n";
        
        // Seed generic institution
        $this->db->query("SELECT id FROM instituciones WHERE nombre = 'Universidad Don Bosco'");
        if(!$this->db->single()){
             $this->db->query("INSERT INTO instituciones (nombre, direccion) VALUES ('Universidad Don Bosco', 'Soyapango')");
             $this->db->execute();
             echo "- Institución 'Universidad Don Bosco' sembrada.\n";
        }

        echo "Migración completada exitosamente.\n";
    }

    private function columnExists($table, $column){
        $this->db->query("SHOW COLUMNS FROM $table LIKE '$column'");
        $result = $this->db->single();
        return !empty($result);
    }
}

$migration = new MigrationEntities();
$migration->run();
