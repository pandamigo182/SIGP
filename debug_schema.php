<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
$tables = ['usuarios', 'empresas', 'plazas', 'postulaciones', 'perfil_estudiantes', 'evaluaciones', 'experiencia_laboral', 'certificados', 'usuario_habilidades'];

echo "--- Schema Analysis ---\n";
foreach($tables as $table){
    echo "\nTABLE: $table\n";
    try {
        $db->query("SHOW CREATE TABLE $table");
        $row = $db->single();
        // The property name depends on the fetch modes, but usually it's "Create Table"
        // Let's print the object to see structure or cast to array
        $rowArr = (array)$row;
        if(isset($rowArr['Create Table'])){
            echo $rowArr['Create Table'] . "\n";
        } else {
             print_r($rowArr);
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage() . "\n";
    }
}
