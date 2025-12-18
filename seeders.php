<?php
// Script de Semillas (Seeders) para SIGP
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

$db = new Database();

echo "<h1>Sembrando Datos de Demostración...</h1>";

try {
    // 1. Roles
    $db->query("INSERT IGNORE INTO roles (id, nombre) VALUES (1, 'Administrador'), (4, 'Empresa'), (5, 'Estudiante')");
    $db->execute();
    echo "Roles insertados.<br>";

    // 2. Departamentos (Ejemplo SV)
    $depts = [
        [1, 'San Salvador', 'SS'],
        [2, 'La Libertad', 'LL'],
        [3, 'Santa Ana', 'SA'],
        [4, 'San Miguel', 'SM']
    ];
    foreach($depts as $dept){
        $db->query("INSERT IGNORE INTO departamentos (id_departamento, departamento, codigo) VALUES (:id, :nom, :cod)");
        $db->bind(':id', $dept[0]);
        $db->bind(':nom', $dept[1]);
        $db->bind(':cod', $dept[2]);
        $db->execute();
    }
    echo "Departamentos insertados.<br>";

    // 3. Usuarios Demo
    // Admin
    $pass = password_hash('123456', PASSWORD_DEFAULT);
    $db->query("INSERT IGNORE INTO usuarios (email, password, nombre, rol_id, estado) VALUES ('admin@sigp.com', '$pass', 'Administrador', 1, 'activo')");
    $db->execute();

    // Empresa
    $db->query("INSERT IGNORE INTO usuarios (email, password, nombre, rol_id, estado) VALUES ('empresa@tech.com', '$pass', 'Tech Solutions', 4, 'activo')");
    $db->execute();
    $empresaId = $db->lastInsertId();
    if($empresaId){
        $db->query("INSERT IGNORE INTO empresas (id, nombre, rubro, departamento_id, municipio_id) VALUES ($empresaId, 'Tech Solutions', 'Tecnología', 1, 1)");
        $db->execute();
    }

    // Estudiante
    $db->query("INSERT IGNORE INTO usuarios (email, password, nombre, rol_id, estado) VALUES ('estudiante@uni.edu', '$pass', 'Juan Pérez', 5, 'activo')");
    $db->execute();

    echo "Usuarios de demostración creados (Pass: 123456).<br>";

    echo "<h2 style='color:green'>Semillas ejecutadas correctamente.</h2>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
