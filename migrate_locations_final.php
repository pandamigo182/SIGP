<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

class MigrationLocationsFinal {
    private $db;

    public function __construct(){
        $this->db = new Database;
        echo "Iniciando Migración Final de Ubicaciones...\n";
        $this->run();
    }

    private function run(){
        $this->dropTables();
        $this->createTables();
        $this->importData();
        echo "Migración Final Completada.\n";
    }

    private function dropTables(){
        echo "Eliminando tablas anteriores...\n";
        $this->db->query("DROP TABLE IF EXISTS distritos");
        $this->db->execute();
        $this->db->query("DROP TABLE IF EXISTS municipios");
        $this->db->execute();
        $this->db->query("DROP TABLE IF EXISTS departamentos");
        $this->db->execute();
    }

    private function createTables(){
        echo "Creando nuevas tablas estructuradas...\n";

        // Departamentos
        $sql = "CREATE TABLE departamentos (
            id_departamento INT PRIMARY KEY,
            codigo_departamento VARCHAR(10),
            departamento VARCHAR(100),
            estado INT DEFAULT 1,
            INDEX(codigo_departamento)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Municipios
        $sql = "CREATE TABLE municipios (
            id_municipio INT PRIMARY KEY,
            codigo_mh_municipio VARCHAR(10),
            codigo_municipio VARCHAR(10),
            codigo_departamento VARCHAR(10),
            municipio VARCHAR(100),
            estado INT DEFAULT 1,
            INDEX(codigo_departamento),
            INDEX(codigo_municipio)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();

        // Distritos
        $sql = "CREATE TABLE distritos (
            id_distrito INT PRIMARY KEY,
            codigo_municipio VARCHAR(10),
            codigo_distrito VARCHAR(10),
            distrito VARCHAR(100),
            estado INT DEFAULT 1,
            INDEX(codigo_municipio)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($sql);
        $this->db->execute();
    }

    private function importData(){
        echo "Importando datos desde locations_data.sql...\n";
        $file = __DIR__ . '/public/databases/locations_data.sql';
        if(!file_exists($file)){
            die("Error: No se encontró locations_data.sql");
        }

        $handle = fopen($file, "r");
        $buffer = "";
        $processing = false;
        
        // Disable FK checks for import
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->execute();

        while (($line = fgets($handle)) !== false) {
            // Check for start of INSERT
            if (preg_match('/insert\s+into\s+`?(\w+)`?/i', $line, $matches)) {
                $table = strtolower($matches[1]);
                // Only process plural tables
                if (in_array($table, ['departamentos', 'municipios', 'distritos'])) {
                    $processing = true;
                    $buffer = $line;
                } else {
                    $processing = false;
                }
                continue;
            }

            if ($processing) {
                $buffer .= $line;
                if (trim($line) === "" || preg_match('/;\s*$/', $line)) {
                    // End of query
                    try {
                        $this->db->query($buffer);
                        $this->db->execute();
                        // echo "Data imported for table.\n";
                    } catch (Exception $e) {
                         echo "Error importing block: " . $e->getMessage() . "\n";
                    }
                    $buffer = "";
                    $processing = false;
                }
            }
        }
        
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");
        $this->db->execute();
        fclose($handle);
    }
}

new MigrationLocationsFinal();
