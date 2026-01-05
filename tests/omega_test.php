<?php
/**
 * OMEGA TEST PROTOCOL
 * 
 * Objetivo: Simular carga masiva y alta concurrencia.
 * Metas: 
 * - 1000 Iteraciones de flujo de usuario.
 * - Simulación de 5000 solicitudes/minuto (Burst).
 * - Cobertura: Login, Chat, Certificados, Pasantías.
 */

// Aumentar límites de memoria y tiempo para la prueba
ini_set('memory_limit', '1024M');
set_time_limit(0);

require_once dirname(__FILE__) . '/../app/config/config.php';

echo "
   ___  __  __  ___  ___   _   
  / _ \|  \/  || __|/ __| /_\  
 | (_) | |\/| || _|| (_ |/ _ \ 
  \___/|_|  |_||___|\___/_/ \_\
  
  PROTOCOLO DE PRUEBA DE CARGA MASIVA
  -----------------------------------
";

$targetUrl = URLROOT;
$concurrentRequests = 20; // Ajustado para XAMPP
$totalIterations = 200; // 20 * 200 = 4000 requests aprox
$totalRequests = 0;
$startTime = microtime(true);
$errors = 0;

// Endpoints a probar con pesos
$scenarios = [
    ['url' => '/users/login', 'method' => 'POST', 'data' => ['email' => 'estudiante@demo.com', 'password' => '123456'], 'weight' => 20],
    ['url' => '/plazas', 'method' => 'GET', 'data' => [], 'weight' => 30],
    ['url' => '/estudiantes/constancia', 'method' => 'GET', 'data' => [], 'weight' => 10], 
    ['url' => '/chat/get_messages', 'method' => 'GET', 'data' => 2, 'weight' => 30],
    ['url' => '/pages/contact', 'method' => 'POST', 'data' => ['name' => 'OmegaUser', 'email' => 'test@omega.com', 'message' => 'Stress Test Message'], 'weight' => 10]
];

echo "\n[INFO] Iniciando $totalIterations ciclos de prueba...";
echo "\n[INFO] Objetivo: Validar concurrencia y flujo de datos.\n\n";

// ... (Rest of code)


// Función para seleccionar escenario
function getScenario($scenarios) {
    $rand = rand(1, 100);
    $current = 0;
    foreach ($scenarios as $s) {
        $current += $s['weight'];
        if ($rand <= $current) return $s;
    }
    return $scenarios[0];
}

// Inicializar multi-curl
$multiHandle = curl_multi_init();
$activeHandles = [];

// Bucle principal
for ($i = 0; $i < $totalIterations; $i++) {
    
    // Llenar el lote concurrente
    while (count($activeHandles) < $concurrentRequests) {
        $scenario = getScenario($scenarios);
        $ch = curl_init();
        $url = $targetUrl . $scenario['url'];
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        if ($scenario['method'] === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($scenario['data']));
        }

        curl_multi_add_handle($multiHandle, $ch);
        $activeHandles[] = $ch;
        $totalRequests++;
    }

    // Ejecutar lote
    $running = null;
    do {
        curl_multi_exec($multiHandle, $running);
        curl_multi_select($multiHandle);
    } while ($running > 0 && count($activeHandles) >= $concurrentRequests);

    // Procesar respuestas
    while ($done = curl_multi_info_read($multiHandle)) {
        $info = curl_getinfo($done['handle']);
        if ($info['http_code'] >= 400 || $info['http_code'] == 0) {
            $errors++;
        }
        
        curl_multi_remove_handle($multiHandle, $done['handle']);
        curl_close($done['handle']);
        
        foreach ($activeHandles as $key => $h) {
            if ($h === $done['handle']) {
                unset($activeHandles[$key]);
                break;
            }
        }
    }
    
    // Reporte de Progreso
    if ($i % 10 == 0 && $i > 0) {
        $elapsed = microtime(true) - $startTime;
        $rate = $totalRequests / ($elapsed > 0 ? $elapsed : 1);
        echo "Ciclo $i completado. Tasa actual: " . number_format($rate, 2) . " req/s\n";
        flush();
    }
}

// Limpiar restantes
$running = null;
do {
    curl_multi_exec($multiHandle, $running);
} while ($running > 0);

curl_multi_close($multiHandle);

$endTime = microtime(true);
$totalTime = $endTime - $startTime;
$reqPerSec = $totalRequests / $totalTime;
$reqPerMin = $reqPerSec * 60;

echo "\n--------------------------------------------------------";
echo "\n RESULTADOS DE PRUEBA OMEGA";
echo "\n--------------------------------------------------------";
echo "\n Tiempo Total      : " . number_format($totalTime, 2) . " s";
echo "\n Solicitudes Total : " . $totalRequests;
echo "\n Errores           : " . $errors;
echo "\n Tasa (Req/Seg)    : " . number_format($reqPerSec, 2);
echo "\n Tasa (Req/Min)    : " . number_format($reqPerMin, 2);
echo "\n--------------------------------------------------------\n";

if ($reqPerMin >= 5000) {
    echo "✅ OBJETIVO DE 5000 REQ/MIN ALCANZADO.\n";
} else {
    echo "⚠️  NO SE ALCANZÓ OJETIVO DE VELOCIDAD (Limitado por cliente o servidor).\n";
}

if ($errors == 0) {
    echo "✅ SISTEMA ROBUSTO: 0 Errores.\n";
} else {
    echo "❌ INESTABILIDAD DETECTADA: $errors Errores.\n";
}
