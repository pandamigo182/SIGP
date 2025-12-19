<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
// Correct usage: query first, then resultSet
$db->query("SHOW TABLES");
$tables = $db->resultSet();
$dbNameKey = "Tables_in_" . DB_NAME;

echo "## Database Schema Analysis\n\n";

if (!$tables) {
    echo "No tables found or connection error.\n";
    exit;
}

foreach ($tables as $tableRow) {
    if (isset($tableRow->$dbNameKey)) {
        $tableName = $tableRow->$dbNameKey;
    } else {
        // Fallback for different PDO fetch modes or casing
        $arr = (array)$tableRow;
        $tableName = array_values($arr)[0];
    }

    echo "### Table: $tableName\n";
    
    $db->query("SHOW COLUMNS FROM $tableName");
    $columns = $db->resultSet();
    
    $hasCreatedAt = false;
    $hasUpdatedAt = false;
    
    foreach ($columns as $col) {
        // echo "- " . $col->Field . " (" . $col->Type . ")\n"; // Detailed view
        if ($col->Field === 'created_at') $hasCreatedAt = true;
        if ($col->Field === 'updated_at') $hasUpdatedAt = true;
    }
    
    echo "**Status**: ";
    if ($hasCreatedAt && $hasUpdatedAt) {
        echo "[OK] Has audit fields.\n";
    } else {
        echo "[MISSING] Needs audit fields.\n";
    }
    echo "-----------------------------------\n";
}
