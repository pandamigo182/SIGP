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

    // Obtener logs con filtros (para Admin)
    public function getLogs($filters = [], $limit = 200, $offset = 0){
        $sql = "SELECT b.*, u.nombre as usuario_nombre, u.email as usuario_email 
                FROM bitacora b 
                LEFT JOIN usuarios u ON b.usuario_id = u.id 
                WHERE 1=1";

        // Filters
        if(!empty($filters['search'])){
            $sql .= " AND (u.nombre LIKE :search OR u.email LIKE :search OR b.ip_address LIKE :search)";
        }
        if(!empty($filters['accion'])){
            $sql .= " AND b.accion = :accion";
        }
        if(!empty($filters['fecha_inicio'])){
            $sql .= " AND DATE(b.created_at) >= :fecha_inicio";
        }
        if(!empty($filters['fecha_fin'])){
            $sql .= " AND DATE(b.created_at) <= :fecha_fin";
        }

        $sql .= " ORDER BY b.created_at DESC LIMIT :limit OFFSET :offset";

        $this->db->query($sql);

        // Bindings
        if(!empty($filters['search'])){
            $this->db->bind(':search', '%' . $filters['search'] . '%');
        }
        if(!empty($filters['accion'])){
            $this->db->bind(':accion', $filters['accion']);
        }
        if(!empty($filters['fecha_inicio'])){
            $this->db->bind(':fecha_inicio', $filters['fecha_inicio']);
        }
        if(!empty($filters['fecha_fin'])){
            $this->db->bind(':fecha_fin', $filters['fecha_fin']);
        }

        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);

        return $this->db->resultSet();
    }

    public function getActions(){
        $this->db->query("SELECT DISTINCT accion FROM bitacora ORDER BY accion ASC");
        return $this->db->resultSet();
    }

    public function countLogs($filters = []){
        $sql = "SELECT COUNT(*) as total 
                FROM bitacora b 
                LEFT JOIN usuarios u ON b.usuario_id = u.id 
                WHERE 1=1";

        if(!empty($filters['search'])){
            $sql .= " AND (u.nombre LIKE :search OR u.email LIKE :search OR b.ip_address LIKE :search)";
        }
        if(!empty($filters['accion'])){
            $sql .= " AND b.accion = :accion";
        }
        if(!empty($filters['fecha_inicio'])){
             $sql .= " AND DATE(b.created_at) >= :fecha_inicio";
        }
        if(!empty($filters['fecha_fin'])){
             $sql .= " AND DATE(b.created_at) <= :fecha_fin";
        }

        $this->db->query($sql);

        if(!empty($filters['search'])){
            $this->db->bind(':search', '%' . $filters['search'] . '%');
        }
        if(!empty($filters['accion'])){
            $this->db->bind(':accion', $filters['accion']);
        }
        if(!empty($filters['fecha_inicio'])){
            $this->db->bind(':fecha_inicio', $filters['fecha_inicio']);
        }
        if(!empty($filters['fecha_fin'])){
            $this->db->bind(':fecha_fin', $filters['fecha_fin']);
        }

        $row = $this->db->single();
        return $row->total;
    }
}
