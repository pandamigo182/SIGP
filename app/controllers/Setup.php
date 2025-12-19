<?php
class Setup extends Controller {
    public function __construct(){
        $this->db = new Database;
    }
    
    public function index(){
        echo "Running Database Updates...<br>";
        
        // Add 2FA columns if not exist
        $sql = "ALTER TABLE usuarios ADD COLUMN secret_2fa VARCHAR(255) DEFAULT NULL, ADD COLUMN enable_2fa TINYINT(1) DEFAULT 0";
        try {
            $this->db->query($sql);
            if($this->db->execute()){
                echo "Columns added successfully.<br>";
            } else {
                echo "Maybe columns already exist.<br>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
        
        echo "Done.";
    }
}
