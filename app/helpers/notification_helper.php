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
