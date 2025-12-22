<?php
class Notification {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addNotification($userId, $message, $type = 'info'){
        $this->db->query('INSERT INTO notificaciones (usuario_id, mensaje, tipo) VALUES (:uid, :msg, :type)');
        $this->db->bind(':uid', $userId);
        $this->db->bind(':msg', $message);
        $this->db->bind(':type', $type);
        return $this->db->execute();
    }

    public function getUnread($userId){
        $this->db->query("SELECT * FROM notificaciones WHERE usuario_id = :uid AND leido = 0 ORDER BY created_at DESC");
        $this->db->bind(':uid', $userId);
        return $this->db->resultSet();
    }
    
    public function markAsRead($id){
        $this->db->query("UPDATE notificaciones SET leido = 1 WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function markAllAsRead($userId){
        $this->db->query("UPDATE notificaciones SET leido = 1 WHERE usuario_id = :uid");
        $this->db->bind(':uid', $userId);
        return $this->db->execute();
    }
}
