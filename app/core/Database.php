<?php
/*
 *  Clase Database
 *  Conexión a BD usando PDO
 *  Prepara sentencias
 *  Vincula valores
 *  Retorna filas y resultados
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; // Database Handler
    private $stmt;
    private $error;

    public function __construct(){
        // Configurar DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Crear instancia PDO
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            $this->dbh->exec("set names utf8");
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Preparar declaración
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Vincular valores
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Ejecutar la declaración
    public function execute(){
        return $this->stmt->execute();
    }

    // Obtener conjunto de resultados como array de objetos
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener un solo registro como objeto
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Obtener cantidad de filas
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    // Transaction Methods
    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function commit(){
        return $this->dbh->commit();
    }

    public function rollBack(){
        return $this->dbh->rollBack();
    }
}
