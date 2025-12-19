<?php
$appRoot = dirname(__DIR__) . '/app';
require_once $appRoot . '/config/config.php';

// Autoloader
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
    
    // Add map_embed_url column
    try {
        $db->query("ALTER TABLE configuracion ADD COLUMN map_embed_url TEXT NULL");
        $db->execute();
        echo "Added column map_embed_url\n";
    } catch (Exception $e) {
        echo "Column map_embed_url might already exist or error: " . $e->getMessage() . "\n";
    }

} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
