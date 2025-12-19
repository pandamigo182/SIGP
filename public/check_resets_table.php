<?php
require_once '../app/config/config.php';

// Autoloader
spl_autoload_register(function($className){
    $paths = ['../app/core/', '../app/models/'];
    foreach($paths as $path){
        if(file_exists($path . $className . '.php')){
            require_once $path . $className . '.php';
            return;
        }
    }
});

try {
    $db = new Database;
    $db->query("SHOW TABLES LIKE 'password_resets'");
    if($db->single()){
        echo "Table password_resets EXISTS.\n";
        $db->query("DESCRIBE password_resets");
        $rows = $db->resultSet();
        foreach($rows as $row){
             echo $row->Field . " - " . $row->Type . "\n";
        }
    } else {
        echo "Table password_resets DOES NOT EXIST.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
