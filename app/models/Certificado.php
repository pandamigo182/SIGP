<?php
class Certificado {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getTemplates(){
        $this->db->query("SELECT * FROM certificados_plantillas ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function addTemplate($nombre, $path){
        // Deactivate others? Maybe only 1 active.
        $this->db->query("INSERT INTO certificados_plantillas (nombre, archivo_fondo, activo) VALUES(:nombre, :path, 1)");
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':path', $path);
        return $this->db->execute();
    }

    public function getActiveTemplate(){
        $this->db->query("SELECT * FROM certificados_plantillas WHERE activo = 1 ORDER BY id DESC LIMIT 1");
        $row = $this->db->single();
        if(!$row){
            // Return a default object if none exists to avoid crash
            $def = new stdClass();
            $def->archivo_fondo = 'default_cert.jpg'; // Needs to exist or code will handle file_exists
            return $def;
        }
        return $row;
    }
}
