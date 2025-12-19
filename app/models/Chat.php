<?php
class Chat {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addMessage($userId, $message, $isAdmin = 0){
        $this->db->query('INSERT INTO chat_messages (user_id, message, is_admin_reply) VALUES (:user_id, :message, :is_admin)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':message', $message);
        $this->db->bind(':is_admin', $isAdmin);
        return $this->db->execute();
    }

    public function getMessages($userId){
        $this->db->query('SELECT * FROM chat_messages WHERE user_id = :user_id ORDER BY created_at ASC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getUnreadCount($userId){ // For user (replies from admin)
        $this->db->query('SELECT COUNT(*) as count FROM chat_messages WHERE user_id = :user_id AND is_admin_reply = 1 AND read_status = 0');
         $this->db->bind(':user_id', $userId);
         $row = $this->db->single();
         return $row->count;
    }

    public function markAsRead($userId, $isAdminReads = false){
        // If Admin reads, we mark User messages as read. If User reads, we mark Admin messages as read.
        $target = $isAdminReads ? 0 : 1; 
        $this->db->query('UPDATE chat_messages SET read_status = 1 WHERE user_id = :user_id AND is_admin_reply = :target');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':target', $target);
        return $this->db->execute();
    }
}
