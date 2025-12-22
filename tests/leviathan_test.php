<?php
/**
 * LEVIATHAN - Script de Pruebas de Estrés y Seguridad para SIGP
 * 
 * Propósito: 
 * 1. Simular carga real masiva (200 usuarios concurrentes: Login -> Dashboard).
 * 2. Simular ataque DoS (Denegación de Servicio).
 * 3. Probar inyección de datos basura.
 */

// Configuración
$base_url = 'http://localhost/SIGP';
$login_url = $base_url . '/auth/login';
$dashboard_url = $base_url . '/dashboard';
$concurrent_users = 20000; // Carga solicitada
$dos_requests = 50000; // Cantidad para ataque DoS rápido

echo "--------------------------------------------------------\n";
echo "   INICIANDO PROTOCOLO LEVIATÁN - PRUEBAS DE ESTRÉS\n";
echo "--------------------------------------------------------\n";
echo "Objetivo: $base_url\n";
echo "Usuarios Concurrentes Simulados: $concurrent_users\n\n";

// --- FASE 1: SIMULACIÓN DE CASO DE USO REAL (Login -> Dashboard) ---
echo "[FASE 1] Simulación de Flujo de Usuario (Login + Acceso Dashboard)...\n";

$mh = curl_multi_init();
$handles = [];
$cookies = []; // Almacenar cookies para cada "usuario"

// Preparar credenciales válidas (Admin)
$post_data = [
    'email' => 'admin@sigp.com',
    'password' => 'admin123'
    // Nota: El CSRF complicaría esto en un script externo sin parsear primero el form.
    // Para efectos de prueba de carga de SERVIDOR, asumimos que pasamos la barrera o deshabilitamos CSRF temporalmente,
    // O hacemos un GET primero para sacar el token (más realista pero costoso computacionalmente aquí).
    // VAMOS A SIMULAR CARGA GET FIRST PARA OBTENER TOKEN, LUEGO POST.
];

// Paso 1.1: GET Login Page (Obtener cookies iniciales y Token si fuera posible parsearlo, 
// aquí simularemos la carga de abrir la página de login masivamente primero)
echo "   -> Paso A: 200 Usuarios abriendo pantalla de Login simultáneamente...\n";

$start_time = microtime(true);

for ($i = 0; $i < $concurrent_users; $i++) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $login_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1); // Necesitamos headers para cookies
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_multi_add_handle($mh, $ch);
    $handles[$i] = $ch;
}

$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running > 0);

$phase1_time = microtime(true) - $start_time;
echo "   -> Tiempo de respuesta masiva (GET): " . number_format($phase1_time, 2) . "s\n";

// Limpiar handles
foreach($handles as $ch) curl_multi_remove_handle($mh, $ch);
$handles = [];


// --- FASE 2: ATAQUE DoS (Inundación) ---
echo "\n[FASE 2] Simulación de Ataque DoS (Inundación HTTP)...\n";
echo "   -> Lanzando $dos_requests peticiones ráfaga sin espera...\n";

$start_time_dos = microtime(true);
$errors = 0;
$success = 0;

$mh_dos = curl_multi_init();
$chunks = array_chunk(range(0, $dos_requests), 50); // Lotes de 50 para no matar la memoria del cliente PHP

foreach ($chunks as $chunk) {
    foreach ($chunk as $i) {
        $ch = curl_init();
        // Atacamos Dashboard directamente (que redirigirá a login, consumiendo CPU en lógica)
        curl_setopt($ch, CURLOPT_URL, $dashboard_url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "LEVIATHAN-BOTNET/User-$i");
        curl_multi_add_handle($mh_dos, $ch);
        $handles[$i] = $ch;
    }
    
    $running = null;
    do {
        curl_multi_exec($mh_dos, $running);
    } while ($running > 0);
    
    // Check status for this chunk
    foreach ($chunk as $i) {
        $info = curl_getinfo($handles[$i]);
        if ($info['http_code'] >= 200 && $info['http_code'] < 400) {
            $success++; // 200 OK or 302 Redirect (Normal operation)
        } elseif ($info['http_code'] >= 500) {
            $errors++; // Server Crash
            echo "   [ALERTA] Fallo detectado (500) en petición $i\n";
        } elseif ($info['http_code'] == 0) {
            $errors++; // Timeout / Connection Refused
            echo "   [CRÍTICO] Servidor dejó de responder en petición $i\n";
        }
        curl_multi_remove_handle($mh_dos, $handles[$i]);
        curl_close($handles[$i]);
    }
    // Pequeña pausa para no bloquear mi propio script, simulando oleadas
    usleep(10000); 
}

curl_multi_close($mh_dos);

$dos_time = microtime(true) - $start_time_dos;
echo "   -> Ataque completado en: " . number_format($dos_time, 2) . "s\n";
echo "   -> Tasa de Peticiones: " . number_format($dos_requests / $dos_time, 2) . " req/s\n";
echo "   -> Respuestas Exitosas (Servidor Vivo): $success\n";
echo "   -> Fallos (Servidor Colapsado): $errors\n";


// --- FASE 3: PRUEBA DE FUZZING (Datos Basura) ---
echo "\n[FASE 3] Prueba de Fuzzing en Formularios (Login)...\n";
$fuzz_payloads = [
    "' OR '1'='1",
    "<script>alert('XSS')</script>",
    str_repeat("A", 10000), // Buffer Overflow attempt simulation
    "%00",
    "admin' --",
    "{{7*7}}" // SSTI attempt
];

$mh_fuzz = curl_multi_init();
$fuzz_handles = [];

foreach($fuzz_payloads as $i => $payload) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $login_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['email' => $payload, 'password' => 'test']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_multi_add_handle($mh_fuzz, $ch);
    $fuzz_handles[$i] = $ch;
}

$running = null;
do {
    curl_multi_exec($mh_fuzz, $running);
} while ($running > 0);

$fuzz_errors = 0;
foreach($fuzz_handles as $ch) {
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($code == 500) {
        echo "   [!] Fallo detectado con payload (Code 500)\n";
        $fuzz_errors++;
    }
    curl_multi_remove_handle($mh_fuzz, $ch);
    curl_close($ch);
}
curl_multi_close($mh_fuzz);

if($fuzz_errors == 0) {
    echo "   -> Fuzzing completado sin errores críticos (Servidor manejó inputs inválidos).\n";
} else {
    echo "   -> ¡ALERTA! Posibles errores 500 detectados durante fuzzing.\n";
}


// --- FASE 4: CARGA EN MÓDULO DE SOPORTE (1000 Mensajes) ---
echo "\n[FASE 4] Prueba Masiva de Soporte (1000 Mensajes)...\n";
$support_url = $base_url . '/pages/contact'; // Endpoint modificado para aceptar POST
$total_msgs = 1000;
$mh_support = curl_multi_init();
$support_chunks = array_chunk(range(0, $total_msgs), 50); // Lotes de 50
$support_start = microtime(true);
$support_success = 0;

foreach ($support_chunks as $chunk) {
    foreach ($chunk as $i) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $support_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'nombre' => "StressUser_$i", 
            'email' => "user$i@test.com", 
            'mensaje' => "This is a stress test message $i meant to load the system."
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_multi_add_handle($mh_support, $ch);
        $handles[$i] = $ch;
    }
    
    $running = null;
    do {
        curl_multi_exec($mh_support, $running);
    } while ($running > 0);
    
    foreach ($chunk as $i) {
        $http_code = curl_getinfo($handles[$i], CURLINFO_HTTP_CODE);
        if($http_code == 200 || $http_code == 302) $support_success++;
        curl_multi_remove_handle($mh_support, $handles[$i]);
        curl_close($handles[$i]);
    }
}
curl_multi_close($mh_support);
$support_time = microtime(true) - $support_start;

echo "   -> 1000 Mensajes enviados en: " . number_format($support_time, 2) . "s\n";
echo "   -> Éxito: $support_success / $total_msgs\n";


echo "\n--------------------------------------------------------\n";
echo "   RESUMEN FINAL\n";
echo "--------------------------------------------------------\n";

if ($phase1_time > 10) {
    echo "⚠️  ADVERTENCIA: Latencia alta en login masivo.\n";
} else {
    echo "✅  RENDIMIENTO: Login masivo estable.\n";
}

if ($errors > 0) {
    echo "❌  VULNERABILIDAD DoS: Servidor colapsó.\n";
} else {
    echo "✅  RESILIENCIA DoS: Servidor resistió inundación.\n";
}

if ($support_success == $total_msgs) {
    echo "✅  SOPORTE: El módulo manejó 1000 mensajes sin pérdida.\n";
} else {
    echo "⚠️  SOPORTE: Se perdieron mensajes durante la carga.\n";
}
echo "--------------------------------------------------------\n";
