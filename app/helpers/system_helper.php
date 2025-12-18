<?php
// Function to get system settings globally
function get_system_settings(){
    // Use the Database class to fetch settings
    // Since this is a helper function, we instantiate DB directly.
    // Ensure Database class is available (Autoloader will handle it if called after init)
    
    static $settingsCache = null;

    if($settingsCache !== null){
        return $settingsCache;
    }

    try {
        $db = new Database; // Relies on Autoloader
        $db->query("SELECT * FROM configuracion LIMIT 1");
        $row = $db->single();
        
        // If no settings (should be seeded), return basic object
        if(!$row){
           $row = (object) [
               'nombre_sistema' => 'SIGP',
               'nombre_empresa' => 'SIGP Corp',
               'email' => 'admin@sigp.sv',
               'direccion' => '',
               'telefono' => '',
               'whatsapp' => '',
               'logo_path' => '',
               'favicon_path' => ''
           ];
        }
        $settingsCache = $row;
        return $row;
    } catch (Exception $e) {
        // Fallback in case of DB error (e.g. migration not run)
        return (object) [
            'nombre_sistema' => SITENAME,
            'nombre_empresa' => 'System',
            'email' => '',
            'direccion' => '',
            'telefono' => '',
            'whatsapp' => '',
            'logo_path' => '',
            'favicon_path' => ''
        ];
    }
}
