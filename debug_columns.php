<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
$tables = ['usuarios', 'empresas', 'plazas'];

foreach($tables as $t){
    echo "TABLE: $t\n";
    $db->query("SHOW COLUMNS FROM $t");
    $cols = $db->resultSet();
    foreach($cols as $c){
        echo $c->Field . " | " . $c->Type . "\n";
    }
    echo "--------------------\n";
}
