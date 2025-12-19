<?php
function get_unread_notifications(){
    if(!isset($_SESSION['user_id'])){
        return [];
    }
    
    // Check if model file exists before requiring to avoid errors if path issues
    if(file_exists(APPROOT . '/models/Notification.php')){
        require_once APPROOT . '/models/Notification.php';
        $notificationModel = new Notification();
        return $notificationModel->getUnread($_SESSION['user_id']);
    } else {
        return [];
    }
}

function notify_admins($message, $type = 'danger'){
    if(file_exists(APPROOT . '/models/Notification.php') && file_exists(APPROOT . '/models/User.php')){
        // We need DB access here. Notification model initiates DB.
        // But we need to find admin IDs first.
        // It's cleaner to handle this in a Controller or Model, but for a helper we need to instantiate.
        
        $db = new Database;
        $db->query("SELECT id FROM usuarios WHERE role_id = 1");
        $admins = $db->resultSet();
        
        $notif = new Notification();
        foreach($admins as $admin){
            $notif->addNotification($admin->id, $message, $type);
        }
    }
}
