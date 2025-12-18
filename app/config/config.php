<?php
// Configuración de acceso a la Base de Datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'sigp_db');

// Ruta de la aplicación
define('APPROOT', dirname(dirname(__FILE__)));

// URL raíz (Dinámica)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
define('URLROOT', $protocol . "://" . $host . "/SIGP");

// Nombre del Sitio
define('SITENAME', 'SIGP - Sistema Integral de Gestión de Pasantías');
