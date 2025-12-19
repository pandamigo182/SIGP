<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'sigp_db');

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $stmt;

    public function __construct(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try{ $this->dbh = new PDO($dsn, $this->user, $this->pass, $options); echo "Connected.\n"; } 
        catch(PDOException $e){ echo "Error: " . $e->getMessage() . "\n"; }
    }
    public function query($sql){ $this->stmt = $this->dbh->prepare($sql); }
    public function execute(){ return $this->stmt->execute(); }
}

$db = new Database;
echo "Creating chat table...\n";
$sql = "CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- The user seeking support
    is_admin_reply TINYINT(1) DEFAULT 0, -- 0 = User msg, 1 = Admin reply
    message TEXT NOT NULL,
    read_status TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
)";
try {
    $db->query($sql);
    if($db->execute()){ echo "Table created.\n"; }
} catch (Exception $e) { echo "Info: " . $e->getMessage() . "\n"; }
echo "Done.\n";
