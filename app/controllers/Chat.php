<?php
class Chat extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            http_response_code(403);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
        $this->chatModel = $this->model('Chat');
    }

    public function get_messages(){
        $userId = $_SESSION['user_id'];
        $messages = $this->chatModel->getMessages($userId);
        
        // Mark as read (User viewing their own chat)
        $this->chatModel->markAsRead($userId, false);

        header('Content-Type: application/json');
        echo json_encode($messages);
    }

    public function send_message(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $postData = json_decode(file_get_contents('php://input'), true);
            $message = trim($postData['message'] ?? '');
            
            if(!empty($message)){
                if($this->chatModel->addMessage($_SESSION['user_id'], $message, 0)){
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error']);
                }
            } else {
                echo json_encode(['status' => 'empty']);
            }
        }
    }
}
