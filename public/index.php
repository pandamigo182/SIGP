<?php
// Cargar archivo de configuración
require_once '../app/config/config.php';

// Manejador Global de Excepciones para Visibilidad del Admin (ISO A.12.4)
set_exception_handler(function($e) {
    // Si la DB ya está cargada podríamos usar el modelo, pero por seguridad usamos PDO directo si es posible
    // o simplemente un log de archivo si DB falla. Intentaremos DB.
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO bitacora (usuario_id, accion, descripcion, ip_address, user_agent, created_at) VALUES (:uid, :act, :desc, :ip, :ua, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':uid' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
            ':act' => 'SYSTEM_FATAL_ERROR',
            ':desc' => 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
            ':ip' => $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN',
            ':ua' => $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN'
        ]);
        
        // Mostrar mensaje amigable al usuario (Seguridad: No mostrar stack trace en prod)
        http_response_code(500);
        die("<h1>Error del Sistema</h1><p>Se ha notificado al administrador. ID de Incidente registrado.</p>");
        
    } catch (Exception $dbErr) {
        // Fallback si DB falla
        error_log("CRITICAL FALLBACK LOG: " . $e->getMessage());
        die("<h1>Error Crítico</h1><p>Contacte a soporte.</p>");
    }
});
require_once '../app/helpers/session_helper.php';
require_once '../app/helpers/notification_helper.php';
require_once '../app/helpers/system_helper.php';
require_once '../app/helpers/security_helper.php';
require_once '../app/helpers/validation_helper.php';

// Autocargar librerías del Core
spl_autoload_register(function($className){
    if(file_exists('../app/core/' . $className . '.php')){
        require_once '../app/core/' . $className . '.php';
    } else if(file_exists('../app/controllers/' . $className . '.php')){
        require_once '../app/controllers/' . $className . '.php';
    } else if(file_exists('../app/models/' . $className . '.php')){
        require_once '../app/models/' . $className . '.php';
    }
});

// Inicializar la clase App (Router)
$init = new App();
