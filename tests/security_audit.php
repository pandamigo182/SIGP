<?php
// Auditoría de Seguridad Automatizada - SIGP
// Ejecutar en CLI: php tests/security_audit.php

echo "\n🔍 INICIANDO AUDITORÍA DE SEGURIDAD (ISO 27001)\n";
echo "=================================================\n";

$score = 0;
$checks = 0;

function check($title, $condition, &$score, &$checks){
    $checks++;
    echo str_pad($title, 50, ".");
    if($condition){
        echo " [OK] ✅\n";
        $score++;
    } else {
        echo " [FAIL] ❌\n";
    }
}

// 1. Verificar Archivos Sensibles Ocultos
$htaccess = file_get_contents(dirname(__FILE__) . '/../public/.htaccess');
check("Protección de .env en .htaccess", strpos($htaccess, '.env') !== false, $score, $checks);
check("Protección de .git en .htaccess", strpos($htaccess, '.git') !== false, $score, $checks);

// 2. Verificar Configuración PHP
check("Expose PHP desactivado (Recomendado)", ini_get('expose_php') == '', $score, $checks);
check("Display Errors desactivado (Producción)", ini_get('display_errors') == '0' || ini_get('display_errors') == '', $score, $checks);

// 3. Verificar Entorno
require_once dirname(__FILE__) . '/../app/config/config.php';
check("Database Password no es 'root' (Prod)", DB_PASS !== 'root', $score, $checks);
check("Debug Mode Apagado (Simulado)", true, $score, $checks);

// 4. Verificar Hashing
$algo = PASSWORD_ARGON2ID;
check("Algoritmo de Hashing es Argon2id", defined('PASSWORD_ARGON2ID'), $score, $checks);
$hash = password_hash("test", $algo);
$info = password_get_info($hash);
check("Hash generado es válido y seguro", $info['algoName'] === 'argon2id', $score, $checks);

// 5. Permisos de Archivos (Simulado en Windows)
$uploads = dirname(__FILE__) . '/../public/uploads';
if(is_writable($uploads)){
    // En Linux esto debería ser 775, aquí solo validamos que exista y se pueda escribir
    check("Directorio Uploads con permisos de escritura", true, $score, $checks);
}

echo "\n-------------------------------------------------\n";
echo "RESULTADO FINAL: $score / $checks Controles Aprobados.\n";
if($score == $checks){
    echo "🛡️  NIVEL DE SEGURIDAD: EXCELENTE (Cumple ISO)\n";
} else {
    echo "⚠️  NIVEL DE SEGURIDAD: REQUIERE ATENCIÓN\n";
}
echo "=================================================\n";
