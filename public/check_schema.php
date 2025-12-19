<?php
// Script to check columns in configuracion table
require_once '../app/config/config.php';

// Autoloader
spl_autoload_register(function($className){
    $paths = ['../app/core/', '../app/libraries/', '../app/models/', '../app/controllers/'];
    foreach($paths as $path){
        if(file_exists($path . $className . '.php')){
            require_once $path . $className . '.php';
            return;
        }
    }
});

try {
    $db = new Database;
    $db->query("DESCRIBE configuracion");
    $columns = $db->resultSet();
    foreach($columns as $col){
        echo $col->Field . " - " . $col->Type . "\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
