<?php
// Script de Ejecución de Migraciones
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Database.php';

// Array de migraciones a ejecutar (en orden)
$migrations = [
    '001_add_audit_fields.sql',
    '002_add_updated_at_columns.sql',
    '003_add_foreign_keys.sql'
];

echo "Iniciando proceso de migración...\n";

$db = new Database();

foreach ($migrations as $file) {
    $migrationPath = __DIR__ . '/' . $file;
    echo "\nProcesando: $file\n";
    
    if (!file_exists($migrationPath)) {
        echo "[ERROR] Archivo no encontrado: $file\n";
        continue;
    }

    $sql = file_get_contents($migrationPath);
    // Split by semicolon but ignore inside quotes (simplified)
    $statements = array_filter(array_map('trim', explode(';', $sql)));

    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            try {
                // Ignore comments
                if(strpos($stmt, '--') === 0) continue;
                
                $db->query($stmt);
                $db->execute();
                // echo "[OK] " . substr($stmt, 0, 30) . "...\n";
            } catch (PDOException $e) {
                // Ignorar errores comunes de "ya existe" para reruns
                $msg = $e->getMessage();
                if (strpos($msg, 'Duplicate column name') !== false || 
                    strpos($msg, 'Duplicate key name') !== false ||
                    strpos($msg, 'already exists') !== false) {
                    echo "[SKIP] Ya aplicado (Duplicate/Exists).\n";
                } elseif (strpos($msg, 'Cannot add foreign key constraint') !== false){
                     echo "[FAIL] Restricción FK fallida (datos inconsistentes?): $msg\n";
                } else {
                    echo "[ERROR] " . $msg . "\n";
                }
            }
        }
    }
}

echo "\n--- Migración completada ---\n";
