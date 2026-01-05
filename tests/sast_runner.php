<?php
// SAST RUNNER - Static Application Security Testing
// Escanea el código fuente buscando patrones inseguros

$rootDir = dirname(__DIR__);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootDir));

$patterns = [
    'DANGER_EVAL' => '/\beval\s*\(/i',
    'DANGER_EXEC' => '/\b(exec|system|passthru|shell_exec)\s*\(/i',
    'WEAK_HASH' => '/\b(md5|sha1)\s*\(/i',
    'XSS_ECHO_GET' => '/echo\s+\$_GET\[/i',
    'SQL_INJECTION_RAW' => '/\$db->query\(\s*["\']SELECT.*\$_(GET|POST)/i',
    'HARDCODED_PASSWORD' => '/password\s*=\s*[\'"][^\'"]+[\'"]/i',
    'DEBUG_DUMP' => '/(var_dump|print_r)\s*\(/i'
];

$vulnerabilities = [];
$scannedFiles = 0;

echo "🛡️  INICIANDO ESCANEO SAST\n";
echo "Dir: $rootDir\n";
echo "--------------------------------------------------\n";

foreach ($files as $file) {
    if ($file->isDir()) continue;
    if (strpos($file->getPathname(), 'vendor') !== false) continue; // Ignorar vendor
    if (strpos($file->getPathname(), '.git') !== false) continue;
    if (pathinfo($file->getPathname(), PATHINFO_EXTENSION) !== 'php') continue;

    $scannedFiles++;
    $content = file_get_contents($file->getPathname());
    $lines = explode("\n", $content);

    foreach ($lines as $lineNum => $line) {
        foreach ($patterns as $type => $regex) {
            if (preg_match($regex, $line)) {
                // False positive filtering
                if(strpos($line, '// SAST_IGNORE') !== false) continue;
                
                $relPath = str_replace($rootDir, '', $file->getPathname());
                $vulnerabilities[] = [
                    'type' => $type,
                    'file' => $relPath,
                    'line' => $lineNum + 1,
                    'code' => trim($line)
                ];
            }
        }
    }
}

echo "Archivos escaneados: $scannedFiles\n";
echo "Vulnerabilidades potenciales: " . count($vulnerabilities) . "\n\n";

if (count($vulnerabilities) > 0) {
    foreach ($vulnerabilities as $v) {
        echo "[{$v['type']}] {$v['file']}:{$v['line']}\n";
        echo "   Code: {$v['code']}\n\n";
    }
    echo "⚠️  SE REQUIERE REVISIÓN MANUAL DE LOS HALLAZGOS.\n";
} else {
    echo "✅ CÓDIGO LIMPIO. No se detectaron patrones obvios.\n";
}
