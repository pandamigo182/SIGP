<?php
$appRoot = dirname(__DIR__) . '/app';
require_once $appRoot . '/config/config.php';

// Autocargar librerías del Core
spl_autoload_register(function($className) use ($appRoot){
    $paths = [$appRoot . '/core/', $appRoot . '/models/'];
    foreach($paths as $path){
        if(file_exists($path . $className . '.php')){
            require_once $path . $className . '.php';
        }
    }
});

try {
    $db = new Database;
    
    // Add columns if they don't exist
    $columnsToAdd = [
        'departamento_id' => 'INT(11) NULL',
        'municipio_id' => 'INT(11) NULL',
        'distrito_id' => 'INT(11) NULL'
    ];

    foreach($columnsToAdd as $col => $type){
        try {
            $db->query("ALTER TABLE configuracion ADD COLUMN $col $type");
            $db->execute();
            echo "Added column $col\n";
        } catch (Exception $e) {
            // Ignore if exists or handle error
            echo "Column $col might already exist or error: " . $e->getMessage() . "\n";
        }
    }
    
    // Also ensuring social media columns are removed if needed, as per previous task?
    // The user didn't mention it now, but previous tasks said to remove them. 
    // I will focus only on fixing the Error 1054 first.

} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
