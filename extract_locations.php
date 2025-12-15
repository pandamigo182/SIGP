<?php
ini_set('memory_limit', '512M');

$inputFile = __DIR__ . '/public/databases/restaurante.sql';
$outputFile = __DIR__ . '/public/databases/locations_data.sql';

if (!file_exists($inputFile)) {
    die("Error: Input file not found at $inputFile");
}

$handle = fopen($inputFile, "r");
$out = fopen($outputFile, "w");

if ($handle) {
    echo "Reading $inputFile...\n";
    $tablesToKeep = ['departamento', 'departamentos', 'municipio', 'municipios', 'distrito', 'distritos', 'canton', 'cantones'];
    $capturing = false;
    $currentTable = '';

    fwrite($out, "SET FOREIGN_KEY_CHECKS=0;\n");

    while (($line = fgets($handle)) !== false) {
        // Start capturing if we hit a relevant INSERT
        if (!$capturing && preg_match('/insert\s+into\s+`?(\w+)`?/i', $line, $matches)) {
            $table = $matches[1];
            if (in_array(strtolower($table), $tablesToKeep)) {
               $capturing = true;
               $currentTable = $table;
            }
        }

        if ($capturing) {
            fwrite($out, $line);
            // Stop capturing if line ends with semicolon (ignoring whitespace)
            if (preg_match('/;\s*$/', $line)) {
                $capturing = false;
            }
        }
    }
    
    fwrite($out, "SET FOREIGN_KEY_CHECKS=1;\n");
    fclose($handle);
    fclose($out);
    echo "Extraction complete. Data saved to $outputFile\n";
} else {
    echo "Error opening input file.\n";
}
?>
