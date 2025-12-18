<?php
// Script de Instalación de Base de Datos para SIGP
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

echo "<!DOCTYPE html><html><head><title>Instalador SIGP</title>";
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "</head><body class='bg-light'><div class='container mt-5'>";
echo "<div class='card shadow'><div class='card-body'>";
echo "<h1 class='text-primary fw-bold text-center mb-4'>Instalador de Base de Datos SIGP</h1>";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $db = new Database();
    
    // 1. Leer estructura
    $structureFile = __DIR__ . '/public/databases/structure.sql';
    if(!file_exists($structureFile)){
        die("<div class='alert alert-danger'>No se encontró el archivo 'public/databases/structure.sql'. Genérelo primero.</div>");
    }
    
    $sql = file_get_contents($structureFile);
    
    try {
        // Ejecutar multi-query es complejo con PDO básico si no está habilitado, 
        // pero intentaremos separar por ;
        $statements = explode(';', $sql);
        foreach($statements as $statement){
            if(trim($statement) != ''){
                $db->query($statement);
                $db->execute();
            }
        }
        echo "<div class='alert alert-success'>Estructura de base de datos importada correctamente.</div>";
        
        // Populate basic data (Roles, Depts) if not in structure
        // This relies on seeders usually, but basic setup might be here.
        echo "<div class='alert alert-info'>Ejecute ahora <strong>Semillas de Demostración</strong> para tener datos de prueba.</div>";
        
    } catch(Exception $e){
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}

echo "<p>Este script instalará la estructura de la base de datos desde <code>public/databases/structure.sql</code>.</p>";
echo "<p class='text-warning'><i class='fas fa-exclamation-triangle'></i> Advertencia: Esto podría borrar tablas existentes si el SQL incluye DROP.</p>";

echo "<form method='POST'>";
echo "<button type='submit' class='btn btn-primary btn-lg w-100'>Instalar Estructura</button>";
echo "</form>";

echo "</div></div></div></body></html>";
