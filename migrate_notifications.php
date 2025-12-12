<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

class MigrateNotifications {
    private $db;

    public function __construct(){
        $this->db = new Database;
        $this->up();
    }

    public function up(){
        // Create Notifications Table
        $sql = "CREATE TABLE IF NOT EXISTS notificaciones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            mensaje TEXT NOT NULL,
            tipo VARCHAR(50) DEFAULT 'info',
            leido BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
        )";
        $this->db->query($sql);
        if($this->db->execute()){
            echo "Table 'notificaciones' created successfully.\n";
        } else {
            echo "Error creating table 'notificaciones'.\n";
        }
    }
}

new MigrateNotifications;
