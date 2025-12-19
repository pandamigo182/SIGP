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
    private $error;

    public function __construct(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            echo "Connected successfully.\n";
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo "Connection failed: " . $this->error . "\n";
        }
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute(){
        return $this->stmt->execute();
    }
}

$db = new Database;
echo "Running Database Updates...\n";
$sql = "ALTER TABLE usuarios ADD COLUMN secret_2fa VARCHAR(255) DEFAULT NULL, ADD COLUMN enable_2fa TINYINT(1) DEFAULT 0";
try {
    $db->query($sql);
    if($db->execute()){
        echo "Columns added successfully.\n";
    }
} catch (Exception $e) {
    echo "Info (likely already exists): " . $e->getMessage() . "\n";
}
echo "Done.\n";
