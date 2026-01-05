<?php
// Función auxiliar para cargar variables de entorno desde .env
if (!function_exists('loadEnv')) {
    function loadEnv($path)
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Cargar variables de entorno
loadEnv(dirname(dirname(dirname(__FILE__))) . '/.env');

// Configuración de acceso a la Base de Datos
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: 'root');
define('DB_NAME', getenv('DB_NAME') ?: 'sigp_db');

// Ruta de la aplicación
define('APPROOT', dirname(dirname(__FILE__)));

// URL raíz (Dinámica)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
define('URLROOT', $protocol . "://" . $host . "/SIGP");

// Nombre del Sitio
define('SITENAME', 'SIGP - Sistema Integral de Gestión de Pasantías');

// Roles de Usuario
define('ROLE_ADMIN', 1);
define('ROLE_COORDINATOR', 2); // Coordinador (Si aplica)
define('ROLE_STUDENT', 3); // Estudiante
define('ROLE_TUTOR', 4); // Tutor
define('ROLE_COMPANY', 5); // Empresa
// Nota: Verificar IDs exactos en base de datos si es necesario.

