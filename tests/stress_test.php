<?php
// Script de Prueba de Carga Simple (Stress Test)
// Simula múltiples conexiones simultáneas al login para verificar estabilidad básica.

$url = 'http://localhost/SIGP/auth/login';
$concurrent_requests = 20;
$mh = curl_multi_init();
$handles = [];

echo "Iniciando prueba de estrés sobre: $url\n";
echo "Solicitudes concurrentes: $concurrent_requests\n";

$start_time = microtime(true);

for ($i = 0; $i < $concurrent_requests; $i++) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // Simular User Agent
    curl_setopt($ch, CURLOPT_USERAGENT, "SIGP-Stress-Tester/1.0");
    
    curl_multi_add_handle($mh, $ch);
    $handles[$i] = $ch;
}

$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running > 0);

$total_time = microtime(true) - $start_time;
$success_count = 0;
$error_count = 0;

foreach ($handles as $ch) {
    if (curl_errno($ch)) {
        $error_count++;
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            $success_count++;
        } else {
            $error_count++;
            echo "HTTP Code: $http_code\n";
        }
    }
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}

curl_multi_close($mh);

echo "\n--- Resultados ---\n";
echo "Tiempo Total: " . number_format($total_time, 4) . " segundos\n";
echo "Exitosos (200 OK): $success_count\n";
echo "Fallidos: $error_count\n";
echo "Promedio por petición: " . number_format($total_time / $concurrent_requests, 4) . " segundos\n";

if ($success_count == $concurrent_requests) {
    echo "ESTADO: PASA (Estabilidad verificada para concurrencia básica)\n";
} else {
    echo "ESTADO: FALLA (Posibles problemas de recursos o conexión)\n";
}
