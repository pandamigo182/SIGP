<?php
$appRoot = dirname(__DIR__) . '/app';
if(file_exists($appRoot . '/config/config.php')) {
    require_once $appRoot . '/config/config.php';
} else {
    die("Config not found at $appRoot/config/config.php");
}

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
    $sql = "CREATE TABLE IF NOT EXISTS password_resets (
        email VARCHAR(255) NOT NULL, 
        token VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->query($sql);
    if($db->execute()){
        echo "Table password_resets created or already exists.\n";
    } else {
        echo "Error creating table.\n";
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}
