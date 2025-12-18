<?php
class Bitacora {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Registrar evento en bitácora
    public function log($usuario_id, $accion, $descripcion){
        require_once APPROOT . '/helpers/security_helper.php';
        
        $ip_address = getClientIp();
        $user_agent = getUserAgent();

        $this->db->query('INSERT INTO bitacora (usuario_id, accion, descripcion, ip_address, user_agent) VALUES (:usuario_id, :accion, :descripcion, :ip_address, :user_agent)');
        
        // Si usuario_id es null (login fallido), pasamos NULL explícitamente o el valor
        $this->db->bind(':usuario_id', $usuario_id);
        $this->db->bind(':accion', $accion);
        $this->db->bind(':descripcion', $descripcion);
        $this->db->bind(':ip_address', $ip_address);
        $this->db->bind(':user_agent', $user_agent);

        return $this->db->execute();
    }

    // Alias for log() to match Admin controller usage
    public function logAction($usuario_id, $accion, $descripcion){
        return $this->log($usuario_id, $accion, $descripcion);
    }

    // Obtener últimos logs (para Admin)
    public function getLogs($limit = 100){
        $this->db->query("SELECT b.*, u.nombre as usuario_nombre, u.email as usuario_email 
                          FROM bitacora b 
                          LEFT JOIN usuarios u ON b.usuario_id = u.id 
                          ORDER BY b.created_at DESC LIMIT :limit");
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
}
