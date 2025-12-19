<?php
// Cargar archivo de configuración
require_once '../app/config/config.php';
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
